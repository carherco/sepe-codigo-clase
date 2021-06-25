<?php

namespace App\Controller\Directorio;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OtroController extends AbstractController
{
    #[Route('/directorio/otro', name: 'directorio_otro')]
    public function index(): Response
    {
        return $this->render('directorio/otro/index.html.twig', [
            'controller_name' => 'OtroController',
        ]);
    }
}