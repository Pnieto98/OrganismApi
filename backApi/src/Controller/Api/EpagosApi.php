<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;

class patenteController extends AbstractController
{
    /**
     * @Route("/api/patente", name="api_patente")
     */
    public function index(HttpClientInterface $client)
    {

        $response = $client->request('POST', 'https://sandbox.epagos.com.ar/post.php', [
            'body' => [
                'id_usuario' => '991',
                'id_organismo' => '83',
                'qpassword' => '71e017eb858d1c03dae87ba85db6dee6',
                'hash' => 'b75a6abbc3da3f23e453cace10f35d81'
            ]
        ]);
        
        $solicitudPago = $client->request('POST', 'https://postsandbox.epagos.com.ar', [
            'body'=>[
                'detalle_operación' => 'asdasd'
            ]
        ]);

        return new JsonResponse(
            $solicitudPago->toArray()
        );

    }
}
