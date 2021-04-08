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
    $this->epagos->set_entorno(0);
    $token = $this->epagos->obtener_token_post("badad406f266a5d93944390eedd20a74", "ac2e7d091343ddd833019a5f82994574");
    $token = $token->token;
    $repositorio = $this->getDoctrine()->getRepository(Comercio::class);
    $totalSaldo = 0;
    $numeroOperacion = "";
    foreach(json_decode($request->getContent()) as $valor){
      $consultaDeuda = $repositorio->findBy(
        ["id" => $valor->id]);
         if($consultaDeuda != null){
          foreach($consultaDeuda as $deuda){  
            $totalSaldo += $deuda->getSaldo();
            $numeroOperacion .= "|".$deuda->getId()."|";
          }
      }
    
      
     
    }
    
    $datosContribuyente = [
      'saldo' => $totalSaldo,
      'token' => $token,
      'numero_operacion' => $numeroOperacion
    ];
    return new JsonResponse($datosContribuyente);
  }
}
