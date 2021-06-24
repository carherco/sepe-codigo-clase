<?php

namespace App\Controller\Private;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class OtroController extends AbstractController
{

    public function otro()
    {
        $name = 'Otro';
        return new Response('<html><head></head><body><h1>Otro, ' . $name . '<h1></body><html>');
    }
}