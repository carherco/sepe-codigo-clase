<?php

namespace App\Controller;

use App\Entity\Fondo;
use App\Form\FondoType;
use App\Repository\FondoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/crud-fondo')]
class CRUDFondoController extends AbstractController
{
    #[Route('/list/{page}', name: 'c_r_u_d_fondo_index', methods: ['GET'], defaults: ['page' => 1, 'title' => 'Hello world!'])]
    public function index(FondoRepository $fondoRepository, $page, $title): Response
    {
        $this->addFlash('info', 'Libro dado de alta correctamente');
        // $itemsPerPage = $this->getParameter('items_per_page');
        $fondos = $fondoRepository->findAllWithAutoresAndEditoriales();
        dump($title);
        return $this->render('crud_fondo/index.html.twig', [
            'fondos' => $fondos,
            'pagina' => $page
        ]);
    }

    #[Route('/new', name: 'c_r_u_d_fondo_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $fondo = new Fondo();
        $form = $this->createForm(FondoType::class, $fondo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fondo);
            $entityManager->flush();

            // $objMensaje = new Mensaje();
            // $objMensaje->setTextoMensaje('Libro dado de alta correctamente');
            // $objMensaje->setLink('http://');
            // $this->addFlash('info', $objMensaje);
            $this->addFlash('info', 'Libro dado de alta correctamente');

            return $this->redirectToRoute('c_r_u_d_fondo_index');
        }

        return $this->render('crud_fondo/new.html.twig', [
            'fondo' => $fondo,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'c_r_u_d_fondo_show', methods: ['GET'], requirements: ["id"=>"\d+"])]
    public function show(Fondo $fondo): Response
    {
        return $this->render('crud_fondo/show.html.twig', [
            'fondo' => $fondo,
        ]);
    }

    #[Route('/{id}/edit', name: 'c_r_u_d_fondo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fondo $fondo): Response
    {
        $form = $this->createForm(FondoTypeForEdit::class, $fondo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('c_r_u_d_fondo_index');
        }

        return $this->render('crud_fondo/edit.html.twig', [
            'fondo' => $fondo,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'c_r_u_d_fondo_delete', methods: ['POST'], requirements: ["id"=>"\d+"])]
    public function delete(Request $request, Fondo $fondo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fondo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fondo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('c_r_u_d_fondo_index');
    }
}
