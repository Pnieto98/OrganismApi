<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Servicios\Epagos\epagosApi;
use Exception;

class ObtenerRespuestaPagoController extends AbstractController
{
    private $epagos;
    private $password;
    private $hash;

    public function __construct()
    {
        $this->epagos =  new epagosApi('0', '219');
        $this->password  = "badad406f266a5d93944390eedd20a74";
        $this->hash = "ac2e7d091343ddd833019a5f82994574";
    }
    
    /**
     * @Route("/api/obtenerPago/{estado}", name="api_obtener_respuesta_pago" )
     */
    public function respuestaPago($estado)
    {
        try {
            $respuesta = $_POST;
            /** Chequear el estado del pago realizado **/
            if ($estado == "aprobado" && $respuesta['id_resp'] == "02001") {
                /** Buscar el link para descargar el recibo PDF y devolverselo a la vista en BASE64**/
                $recibo = base64_encode($this->obtenerReciboPago($respuesta['id_transaccion']));
                return  $this->redirect("http://localhost:4200/resultadoPago/acreditado/{$recibo}");
            }
            return $this->redirect("http://localhost:4200/resultadoPago/error");
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    public function obtenerReciboPago($id_transaccion)
    {
        /** Busca en la api el id_transaccion de la boleta **/
        $criterios = ["ESTADO" => "A", "CodigoUnicoTransaccion" => $id_transaccion];
        $obtenerPagos = $this->epagos->obtener_pagos($criterios, $this->password, $this->hash);
        $recibo = $obtenerPagos['pago'][0]->Recibo;
        return $recibo;
    }
}
