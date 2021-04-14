<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ObtenerRespuestaPagoController extends AbstractController
{
    /**
     * @Route("/api/obtenerPago/{estado}", name="api_obtener_respuesta_pago" )
     */
    public function obtenerPagos( $estado)
    {   
        $respuesta = $_POST;
        if($estado == "aprobado" && $respuesta['id_resp'] == "02001"){
           return  $this->redirect("http://localhost:4200/resultadoPago/acreditado");
        }
        return $this->redirect("http://localhost:4200/resultadoPago/error");
    }
}
