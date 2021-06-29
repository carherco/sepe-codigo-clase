<?php

namespace App\Controller;

use App\Entity\Autor;
use App\FakeData\Catalogo;    // <==== IMPORTANTE
use App\Repository\FondoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogoController extends AbstractController
{
    #[Route('/catalogo/libros', name: 'catalogo')]
    public function index(): Response
    {
        $fondos = Catalogo::$fondos;

        $colores = ['rojo', 'amarillo', 'verde'];

        return $this->render('catalogo/index.html.twig', [
            'fondos' => $fondos,
            'colores' => $colores
        ]);
    }

    #[Route('/catalogo/ver', name: 'catalogo_ver')]
    public function ver(FondoRepository $fondoRepository): Response
    {
        $fondo = $fondoRepository->find(1);

        dump($fondo->getEditorial()->getNombre());

        return $this->render('catalogo/index.html.twig', [
            'fondos' => [],
            'colores' => [],
            'fondo' => $fondo
        ]);
    }
}
