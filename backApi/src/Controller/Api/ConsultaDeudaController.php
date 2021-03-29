<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsultaDeudaController extends AbstractController
{
    /**
     * @Route("/api/consulta/deuda", name="api_consulta_deuda")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Api/ConsultaDeudaController.php',
        ]);
    }
}
