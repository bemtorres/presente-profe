<?php

namespace App\Services;

use App\Mail\SolicitudEmail;
use Illuminate\Support\Facades\Mail;

class EmailServices
{
  private $mailClients;
  private $mailAdmins;
  private $params;

  const subjets = [
    'solicitud' => 'Solicitud de reserva de sala',
    'solicitudAprobada' => 'Solicitud de reserva de sala aprobada',
    'solicitudRechazada' => 'Solicitud de reserva de sala rechazada',
  ];

  public function __construct($mailClients, $mailAdmins, $params){
    $this->mailClients = $mailClients;
    $this->mailAdmins = $mailAdmins;
    $this->params = $params;
  }

  public function solicitud() {
    $subject = self::subjets['solicitud'];

    $params = [
      'subject' => $subject,
      'params' => $this->params,
    ];

    Mail::to($this->mailClients)->queue(new SolicitudEmail($params));
  }

  public function solicitudAprobada() {
    $subject = self::subjets['solicitudAprobada'];

  }

  public function solicitudRechazada() {
    $subject = self::subjets['solicitudRechazada'];

  }
}
