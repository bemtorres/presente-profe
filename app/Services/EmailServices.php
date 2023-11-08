<?php

namespace App\Services;

class EmailServices
{
  private $mailClients;
  private $mailAdmins;

  const subjets = [
    'solicitud' => 'Solicitud de reserva de sala',
    'solicitudAprobada' => 'Solicitud de reserva de sala aprobada',
    'solicitudRechazada' => 'Solicitud de reserva de sala rechazada',
  ];

  public function __construct($mailClients, $mailAdmins){
    $this->mailClients = $mailClients;
    $this->mailAdmins = $mailAdmins;
  }

  public function solicitud() {
    $subject = self::subjets['solicitud'];

  }

  public function solicitudAprobada() {
    $subject = self::subjets['solicitudAprobada'];

  }

  public function solicitudRechazada() {
    $subject = self::subjets['solicitudRechazada'];

  }
}
