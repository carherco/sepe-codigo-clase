<?php

namespace App\Services;

use App\Repository\FondoRepository;

class LibrosManager {

  private $fondoRepository;
  public function __construct(FondoRepository $fondoRepository) {
    $this->fondoRepository = $fondoRepository;
  }

  public function getJsonFondos() {
    $fondos = $this->fondoRepository->findAll();

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
    return $fondosArray;
  }

  public function arrayToJson($fondos) {

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
    return $fondosArray;
  }
}