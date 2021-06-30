<?php

namespace App\Controller;

use App\Entity\Autor;
use App\Entity\Fondo;
use App\FakeData\Catalogo;    // <==== IMPORTANTE
use App\Repository\FondoRepository;
use App\Repository\EditorialRepository;
use App\Repository\AutorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogoController extends AbstractController
{
    #[Route('/catalogo/libros', name: 'catalogo')]
    public function index(FondoRepository $fondoRepository): Response
    {
        //$fondos = Catalogo::$fondos;
        $fondos = $fondoRepository->findAll();

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
        return $this->render('catalogo/ver.html.twig', [
            'fondo' => $fondo
        ]);
    }

    #[Route('/catalogo/crear-con-editorial', name: 'catalogo_crear-con-editorial')]
    public function cce(
        EditorialRepository $editorialRepository,
        AutorRepository $autorRepository,
        FondoRepository $fondoRepository,
        EntityManagerInterface $em
        ): Response
    {
        $editorialNombre = 'Seix Barral';
        $autorId = 5;

        $titulo = 'Symfony: The Fast Track';
        $isbn = '84-204-6583-5';
        $edicion = 2005;
        $publicacion = 2005;
        $categoria = 'Ficción';
        
        $editorial = $editorialRepository->findOneByNombre($editorialNombre);
        $autor = $autorRepository->find($autorId);

        $fondo = new Fondo();
        $fondo->setTitulo($titulo);
        $fondo->setIsbn($isbn);
        $fondo->setEdicion($edicion);
        $fondo->setPublicacion($publicacion);
        $fondo->setCategoria($categoria);
        $fondo->setEditorial($editorial);
        $fondo->addAutor($autor);

        $em->persist($fondo);
        $em->flush();

        $fondos = $fondoRepository->findAll();

        return $this->render('catalogo/index.html.twig', [
            'fondos' => $fondos
        ]);
    }
}
