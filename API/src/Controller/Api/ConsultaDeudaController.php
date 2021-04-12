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
    public function Consulta($comercio, $id)
    {
        $repositorio = $this->obtenerRopositorioTributo($comercio);
        $arrayDeuda = [];
        $response = new JsonResponse();
        $consultaDeuda = $repositorio->findBy(
            ["cuenta" => $id,
             "estado" => 0]

        );
        if ($consultaDeuda != null) {
            foreach ($consultaDeuda as $deuda) {
                $arrayDeuda [] = [
                    "id" => $deuda->getId(), 
                    "cuenta" => $deuda->getCuenta(),
                    "saldo"=>$deuda->getSaldo(),
                    "periodo"=>date("d-m-Y", strtotime($deuda->getPeriodo())),
                    "venicimiento"=>$deuda->getVencimiento(),
                    "descripcion"=>$deuda->getDescripcion(),
                    "nombreContribuyente" => $deuda->getIdContribuyente()->getNombre(),
                    "dni" => $deuda->getIdContribuyente()->getDni()

                ];
            }
            $response->setData([
                "message" => true,
                "deuda" =>$arrayDeuda
            ]
            );
        }else{
            $response->setData([
                "message" => false
            ]);
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
