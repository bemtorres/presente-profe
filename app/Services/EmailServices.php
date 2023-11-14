<?php

namespace App\Services;

use App\Mail\AprobadoEmail;
use App\Mail\CanceladoEmail;
use App\Mail\RechazadoEmail;
use App\Mail\SolicitudEmail;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Mail;

class EmailServices
{
  private $mailClients;
  private $mailAdmins;
  private $solicitud_id;

  const subjets = [
    'solicitud' => 'Solicitud de reserva de sala',
    'solicitudAprobada' => 'Solicitud de reserva de sala aprobada',
    'solicitudRechazada' => 'Solicitud de reserva de sala rechazada',
    'solicitudCancelada' => 'Solicitud de reserva de sala cancelada',
  ];

  public function __construct($mailClients,$mailAdmins = [], int $solicitud_id){
    $this->mailClients = $mailClients;
    $this->mailAdmins = $mailAdmins;
    $this->solicitud_id = $solicitud_id;
  }

  public function solicitud() {
    $subject = self::subjets['solicitud'];
    $s = Solicitud::with(['registros'])->findOrFail($this->solicitud_id);

    $registros = (new RegistroDias($s->registros))->resumen();
    $info = [
      'sala' => $s->sala->nombre ?? '',
      'registro' => $registros ?? null,
      'motivo' => $s->getMotivo(),
      'comentario' => $s->comentario ?? '',
      'semana_text' => $s->sem->getInfo()
    ];

    $mail = new SolicitudEmail($subject, $info);
    // return $mail;
    Mail::to($this->mailClients)->queue($mail);

    return true;
  }

  public function solicitudAprobada() {
    $subject = self::subjets['solicitudAprobada'];
    $s = Solicitud::with(['registros'])->findOrFail($this->solicitud_id);

    $registros = (new RegistroDias($s->registros))->resumen();
    $info = [
      'sala' => $s->sala->nombre ?? '',
      'registro' => $registros ?? null,
      'motivo' => $s->getMotivo(),
      'comentario' => $s->comentario ?? '',
      'semana_text' => $s->sem->getInfo()
    ];

    $mail = new AprobadoEmail($subject, $info);
    // return $mail;
    Mail::to($this->mailClients)->queue($mail);

    return true;
  }

  public function solicitudRechazada() {
    $subject = self::subjets['solicitudRechazada'];
    $s = Solicitud::with(['registros'])->findOrFail($this->solicitud_id);

    $registros = (new RegistroDias($s->registros))->resumen();
    $info = [
      'sala' => $s->sala->nombre ?? '',
      'registro' => $registros ?? null,
      'motivo' => $s->getMotivo(),
      'comentario' => $s->comentario ?? '',
      'semana_text' => $s->sem->getInfo()
    ];

    $mail = new RechazadoEmail($subject, $info);
    Mail::to($this->mailClients)->queue($mail);

    return true;
  }

  public function solicitudCancelado() {
    $subject = self::subjets['solicitudCancelada'];
    $s = Solicitud::with(['registros'])->findOrFail($this->solicitud_id);

    $registros = (new RegistroDias($s->registros))->resumen();
    $info = [
      'sala' => $s->sala->nombre ?? '',
      'registro' => $registros ?? null,
      'motivo' => $s->getMotivo(),
      'comentario' => $s->comentario ?? '',
      'semana_text' => $s->sem->getInfo()
    ];

    $mail = new CanceladoEmail($subject, $info);
    Mail::to($this->mailClients)->queue($mail);

    return true;
  }
}
