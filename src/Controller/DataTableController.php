<?php

namespace App\Controller;

use App\Repository\FondoRepository;
use App\Services\LibrosManager;
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
    public function libros_json(LibrosManager $manager): Response
    {
        // Opción A)
        $fondosArray = $manager->getJsonFondos();
        
        // Opción B)
        // $fondos = $this->fondoRepository->findAll();
        // $fondosArray = $manager->arrayToJson($fondos);

        $content = [
            'data' => $fondosArray
        ];

        return new JsonResponse($content);
    }
}
