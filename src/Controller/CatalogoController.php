<?php

namespace App\Controller;

use App\FakeData\Catalogo;    // <==== IMPORTANTE
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogoController extends AbstractController
{
    #[Route('/catalogo', name: 'catalogo')]
    public function index(): Response
    {

        $fondos = Catalogo::$fondos;

        $colores = ['rojo', 'amarillo', 'verde'];
        return $this->render('catalogo/index.html.twig', [
            'fondos' => $fondos,
            'colores' => $colores
        ]);
    }
}
