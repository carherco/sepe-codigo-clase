<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class PublicController extends AbstractController
{
    public function login()
    {
        return $this->render('public/login.html.twig');
    }

    /**
     * @Route("/about-us", name="about-us")
     * @Route("/about", name="about")
     * @Route("/aboutus", name="aboutus")
     */
    public function about()
    {
        return $this->render('public/about.html.twig');
    }

    
}