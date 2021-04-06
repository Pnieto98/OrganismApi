<?php

namespace App\Controller\Api;

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
    $this->epagos = new epagosApi("37", "53");
  }
  /**
   * @Route("/api/pago/deuda", name="api_pago_deuda", methods={"POST", "GET"})
   */
  public function obtenerSolicitudPago(Request $request)
  {
    header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    $this->epagos->set_entorno(0);
    $token = $this->epagos->obtener_token_post("b8de042653969bcc5881bb1c71c03a7b", "aeda258e332110a2352d1ca21b8dd337");
    $token = $token->token;
    exit("<html>
        <body>
        <form name='pago' method='post' action='https://postsandbox.epagos.com.ar'>
        <input type='hidden' name='version' value='2.0' />
        <input type='hidden' name='operacion' value='op_pago' />
        <input type='hidden' name='id_organismo' value='37' />
        <input type='hidden' name='convenio' value='' />
        <input type='hidden' name='token' value='$token' />
        <input type='hidden' name='numero_operacion' value='1' />
        <input type='hidden' name='id_moneda_operacion' value='1' />
        <input type='hidden' name='monto_operacion' value='300' />
        <input type='hidden' name='detalle_operacion' value='' />
        <input type='hidden' name='detalle_operacion_visible' value='0' />
        <input type='hidden' name='ok_url' value='https://postsandbox.epagos.com.ar/tests/ok.php' />
        <input type='hidden' name='error_url' value='https://postsandbox.epagos.com.ar/tests/error.php' />
        <br/><input type='submit' value='Enviar pago' />
      </form>
      <script>
      window.onload=function(){
          document.forms['pago'].submit();
      }
      </script>
        </body>
      </html>");

    return new JsonResponse("asdasdasdasd");
  }
}
