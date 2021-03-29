<?php

namespace App\Controller\Api;

use App\Entity\Comercio;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsultaDeudaController extends AbstractController
{
    /**
     * @Route("/api/consulta/{comercio}/{id}", 
     * name="api_consulta_deuda", methods={"GET"})
     */
    public function Consulta($id, $comercio)
    {
        $repositorio = $this->obtenerRopositorioTributo($comercio);
        $arrayDeuda = [];
        $response = new JsonResponse();
        $consultaDeuda = $repositorio->findAll();
        if ($consultaDeuda != null) {
            foreach ($consultaDeuda as $deuda) {
                $arrayDeuda[] = [
                    "id" => $deuda->getId()
                ];
            }
            $response->setData([
                "message" => true,
                "deuda" =>$arrayDeuda
            ]
            );
        }
        return $response;
    }
    private function obtenerRopositorioTributo($tributos)
    {
        if ($tributos != "") {
            $repositorio = null;
            switch ($tributos) {
                case "comercio":
                    $repositorio = $this->getDoctrine()->getRepository(Comercio::class);
                    break;
                case "patente":
                    $repositorio = $this->getDoctrine()->getRepository(Comercio::class);
                    break;
            }
            return $repositorio;
        }
    }
}
