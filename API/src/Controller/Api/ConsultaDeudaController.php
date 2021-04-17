<?php

namespace App\Controller\Api;

use App\Entity\Comercio;
use App\Entity\Contribuyentes;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
            [
                "cuenta" => $id,
                "estado" => 0
            ]

        );
        if ($consultaDeuda != null) {
            foreach ($consultaDeuda as $deuda) {
                $arrayDeuda[] = [
                    "id" => $deuda->getId(),
                    "cuenta" => $deuda->getCuenta(),
                    "saldo" => $deuda->getSaldo(),
                    "periodo" => date("d-m-Y", strtotime($deuda->getPeriodo())),
                    "venicimiento" => $deuda->getVencimiento(),
                    "descripcion" => $deuda->getDescripcion(),
                    "nombreContribuyente" => $deuda->getIdContribuyente()->getNombre(),
                    "dni" => $deuda->getIdContribuyente()->getDni()

                ];
            }
            $response->setData(
                [
                    "message" => true,
                    "deuda" => $arrayDeuda
                ]
            );
        } else {
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
    /**
     **@Route("/api/obtenerDeuda/{tributo}/{tipoId}/{id}", 
     * name="api_consulta_deuda", methods={"GET"})
     */
    public function obtenerDeuda(string $tributo, string $tipoId, string $id){
        $arrayDeuda = [];
        $datosDeuda = [];
        $response = new JsonResponse();

        if ($tipoId == "doc") {
            $repo =  $this->getDoctrine()->getRepository(Contribuyentes::class);
            $deudaContri = $repo->findOneBy(['dni' => $id]);
            if($deudaContri){
            $arrayDeuda = $this->obtenerDeudaDni($tributo, $deudaContri);
            }
        }  
        
        if($arrayDeuda != null){
            foreach($arrayDeuda as $deuda){
                $datosDeuda[] = [
                    "id_externo" => $deuda->getId(),
                    "tipo_tributo" => $tributo,
                    "monto" => $deuda->getSaldo(),
                    "periodo" =>$deuda->getPeriodo(),
                    "vencimiento"=>$deuda->getVencimiento()->format("Y-m-d"),
                    "descripcion"=>$deuda->getDescripcion()          
                ];
            }
            $response->setData([
                "message" => true,
                "datosDeuda"=>$datosDeuda,
                "datosContribuyente"=>[
                 "nombre" => $deudaContri->getNombre(),
                 "dni" => $deudaContri->getDni(),
                 "email" => $deudaContri->getMail()
                ]
            ]);
        }else{
            $response->setData([
                "message" => false
            ]);
        }
       
        return $response;
    }
    private function obtenerDeudaDni($tributo, $deudaContri)
    {
       
        $deudaTributos = $deudaContri->getDeudaTributo($tributo);
        if ($deudaTributos != null) {
            $arrayDeuda = [];
            foreach ($deudaTributos as $deuda) {
                if ($deuda->getEstado() == false) {
                    $arrayDeuda[] = $deuda;
                }
            }
            return $arrayDeuda;
        }
        return null;
    }
    
}
