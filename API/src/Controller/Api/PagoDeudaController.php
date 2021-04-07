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
    return new JsonResponse($token);
  }
}
