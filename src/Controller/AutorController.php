<?php

namespace App\Controller;

use App\Entity\Autor;
use App\Entity\Editorial;
use App\Entity\Fondo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AutorController extends AbstractController
{
    #[Route('/autor', name: 'autor')]
    public function index(EntityManagerInterface $em): Response
    {   
        $autor = new Autor();
        $autor->setTipo('persona');
        $autor->setNombre('Pérez Reverte');

        $autor2 = new Autor();
        $autor2->setTipo('entidad');
        $autor2->setNombre('Banco de España');

        $autor3 = new Autor();
        $autor3->setTipo('persona');
        $autor3->setNombre('J. K. Rowling');

        $autores = [$autor, $autor2, $autor3];

        $editorial = new Editorial();
        $editorial->setNombre('Seix Barral');

        $editorial2 = new Editorial();
        $editorial2->setNombre('El Barco de Vapor');

        $em->persist($autor);
        $em->persist($autor2);
        $em->persist($autor3);
    
        $em->persist($editorial);
        $em->persist($editorial2);

        $fondo = new Fondo();
        $fondo->setTitulo('Harry Potter');
        $fondo->setIsbn('84-204-8312-5');
        $fondo->setEdicion(1998);
        $fondo->setPublicacion(1998);
        $fondo->setCategoria('Novela');
        $fondo->setEditorial($editorial);
        $fondo->addAutor($autor);

        $em->persist($fondo);
        $em->flush();
        

        return $this->render('autor/index.html.twig', [
            'controller_name' => 'AutorController',
            'autores' => $autores
        ]);
    }
}
