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
        $personas = [
            [
              'name' => 'Carlos',
              'age' => 21
            ],
            [
              'name' => 'Carmen',
              'age' => 16
            ],
            [
              'name' => 'Carla',
              'age' => 32
            ],
            [
              'name' => 'Carlota',
              'age' => 17
            ],
        ];
          
        $personas[2]['age']; // 32

        $name = 'Carlosssssss';
        return $this->render('ejemplo/saludar.html.twig', [
            'nombre' => $name,
            'age' => 21,
            'personas' => $personas
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