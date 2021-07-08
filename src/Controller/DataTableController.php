<?php

namespace App\Controller;

use App\Repository\FondoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DataTableController extends AbstractController
{
    #[Route('/datatable', name: 'data_table')]
    public function index(): Response
    {
        return $this->render('data_table/index.html.twig', [
            'controller_name' => 'DataTableController',
        ]);
    }

    #[Route('/libros_json', name: 'libros_json')]
    public function libros_json(FondoRepository $fondoRepository): Response
    {
        $fondos = $fondoRepository->findAll();

        $fondosArray = [];
        foreach($fondos as $fondo) {
            $fondoArray = [
                $fondo->getTitulo(),
                $fondo->getIsbn(),
                $fondo->getEdicion(),
                $fondo->getPublicacion()
            ];
            $fondosArray[] = $fondoArray;
        }

        $content = [
            'data' => $fondosArray
        ];

        return new JsonResponse($content);
    }
}
