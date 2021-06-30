<?php

namespace App\Controller;

use App\Entity\Fondo;
use App\Repository\FondoRepository;
use App\Repository\EditorialRepository;
use App\Repository\AutorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CatalogoController extends AbstractController
{
    #[Route('/catalogo/libros', name: 'catalogo')]
    public function index(FondoRepository $fondoRepository): Response
    {
        //$fondos = Catalogo::$fondos;
        $fondos = $fondoRepository->findAll();

        return $this->render('catalogo/index.html.twig', [
            'fondos' => $fondos,
        ]);
    }

    #[Route('/catalogo/ver/{id}', name: 'catalogo_ver')]
    public function ver($id, FondoRepository $fondoRepository): Response
    {
        $fondo = $fondoRepository->find($id);
        
        if(!$fondo) {
            return $this->render('comun/recurso-no-encontrado.html.twig', [
                'mensaje' => 'Este libro no existe'
            ]);
        }

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
        $editorialNombre = 'El Barco de Vapor';
        $autorId = 4;

        $titulo = 'Otro libro';
        $isbn = '84-204-6583-5';
        $edicion = 2005;
        $publicacion = 2005;
        $categoria = 'Ficción';
        
        $editorial = $editorialRepository->findOneByNombre($editorialNombre);
        $autor = $autorRepository->find($autorId);
        $autor5 = $autorRepository->find(5);

        $fondo = new Fondo();
        $fondo->setTitulo($titulo);
        $fondo->setIsbn($isbn);
        $fondo->setEdicion($edicion);
        $fondo->setPublicacion($publicacion);
        $fondo->setCategoria($categoria);
        $fondo->setEditorial($editorial);
        $fondo->addAutor($autor);
        $fondo->addAutor($autor5);

        $em->persist($fondo);
        $em->flush();

        $fondos = $fondoRepository->findAll();

        return $this->render('catalogo/index.html.twig', [
            'fondos' => $fondos
        ]);
    }

    #[Route('/catalogo/modificar', name: 'catalogo_modificar')]
    public function modificar(
        FondoRepository $fondoRepository,
        EntityManagerInterface $em
        ): Response
    {
        $id = 4;
        $publicacion = 2006;
        
        $fondo = $fondoRepository->find($id);
        $fondo->setPublicacion($publicacion);

        $em->persist($fondo);
        $em->flush();

        $fondos = $fondoRepository->findAll();

        return $this->render('catalogo/index.html.twig', [
            'fondos' => $fondos
        ]);
    }

    #[Route('/catalogo/eliminar', name: 'catalogo_eliminar')]
    public function eliminar(
        FondoRepository $fondoRepository,
        EntityManagerInterface $em
        ): Response
    {
        $id = 5;
        
        $fondo = $fondoRepository->find($id);

        $em->remove($fondo);
        $em->flush();

        $fondos = $fondoRepository->findAll();

        return $this->render('catalogo/index.html.twig', [
            'fondos' => $fondos
        ]);
    }
}
