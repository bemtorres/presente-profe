<?php

namespace App\Services;

class CarreraData {

  CONST NOMBRES = [
    'Ingeniería Civil en Informática',
    'Ingeniería Civil en Computación',
    'Ingeniería Civil en Telecomunicaciones',
    'Ingeniería Civil Industrial',
    'Ingeniería Civil en Obras Civiles',
    'Ingeniería Civil en Electricidad',
    'Ingeniería Civil en Mecánica',
    'Ingeniería Civil en Química',
    'Ingeniería Civil en Matemática',
    'Ingeniería Civil en Biotecnología',
    'Ingeniería Civil en Geomensura',
    'Ingeniería Civil en Geología',
    'Ingeniería Civil en Minas',
    'Ingeniería Civil en Metalurgia',
    'Ingeniería Civil en Biotecnología',
    'Ingeniería Civil en Industrias de la Madera',
    'Ingeniería Civil en Acuicultura',
    'Ingeniería Civil en Alimentos',
  ];

  static function getConvert($money, $decimal = 0) {
    return number_format($money, $decimal, ',', '.');
  }
}
