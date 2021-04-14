<?php

namespace App\Controller\Api;
use App\Entity\Comercio;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Servicios\Epagos\epagosApi;

class PagoDeudaController extends AbstractController
{
  private $epagos;

  public function __construct()
  {
    $this->epagos = new epagosApi("0", "219");
  }

  /**
   * @Route("/api/pago/deuda", name="api_pago_deuda", methods={"POST"})
   */
  public function obtenerSolicitudPago(Request $request)
  {
    $token = $this->obtenerToken();
    $repositorio = $this->getDoctrine()->getRepository(Comercio::class);

    /*Inicializar variables */
    $totalSaldo = 0;
    $numeroOperacion = "";
    $detalleOperacion = [];
    $idItem = 0;

    /*Recorriendo los datos obtenidos en POST */
    foreach(json_decode($request->getContent()) as $valor){
      $consultaDeuda = $repositorio->findBy(
        ["id" => $valor->id]);

        /*Chequear si existe el número de cuenta enviado en la BD */
         if($consultaDeuda != null){
          foreach($consultaDeuda as $deuda){  
            $totalSaldo += $deuda->getSaldo();
            $numeroOperacion .= "|".$deuda->getId()."|";
            $detalleOperacion[] = 
            [
              'id_item' => $idItem++,
              'desc_item'=>$deuda->getPeriodo(),
              'monto_item'=>$deuda->getSaldo(),
              'cantidad_item'=>'1'
            ];
          }
      }
    }
    /** Datos para pasarle al form en la UI **/
    $datosContribuyente = [
      "version" => '2.0',
      "operacion"=>"op_pago",
      "id_organismo" => '0',
      "token" => $token,
      "convenio" => "",
      "id_moneda_operacion"=>"1",
      "monto_operacion"=>$totalSaldo,
      "detalle_operacion" => urlencode(json_encode($detalleOperacion)),
      "detalle_operacion_visible"=> "1",
      "ok_url" => 'https://postsandbox.epagos.com.ar/tests/ok.php',
      "error_url" => 'https://postsandbox.epagos.com.ar/tests/error.php'
    ];
    return new JsonResponse($datosContribuyente);
  }
  private function obtenerToken(){
    $this->epagos->set_entorno(0);
    $token = $this->epagos->obtener_token_post("badad406f266a5d93944390eedd20a74", "ac2e7d091343ddd833019a5f82994574");
    return $token->token;
  }
}
