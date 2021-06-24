<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class EjemploController extends AbstractController
{
    /**
     * @Route("/hola", name="hola")
     */
    public function saludo()
    {
        $name = 'Carlosssssss';
        return $this->render('ejemplo/saludar.html.twig', [
            'nombre' => $name,
            'age' => 21
        ]);
    }

    /**
     * @Route("/adios", name="adios")
     */
    public function adios()
    {
        $name = 'Carlos';
        return new Response('<html><body>Adiós, ' . $name . '</body><html>');
    }
}