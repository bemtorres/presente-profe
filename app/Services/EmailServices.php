<?php

namespace App\Services;

use App\Mail\AprobadoEmail;
use App\Mail\CanceladoEmail;
use App\Mail\RechazadoEmail;
use App\Mail\SolicitudEmail;
use App\Models\Sede;
use App\Models\Sistema;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Mail;

class EmailServices
{
  private $mail_client;
  private $mail_admin;
  private $solicitud_id;
  private $sistema;

  const subjets = [
    'solicitud' => 'Solicitud de reserva de sala',
    'solicitudAprobada' => 'Solicitud de reserva de sala aprobada',
    'solicitudRechazada' => 'Solicitud de reserva de sala rechazada',
    'solicitudCancelada' => 'Solicitud de reserva de sala cancelada',
  ];

  public function __construct($mail_client,$mail_admin = [], int $solicitud_id){
    $this->sistema = $this->build_sistema();
    $this->mail_client = $mail_client;
    $this->mail_admin = $mail_admin;
    $this->solicitud_id = $solicitud_id;
    $this->active_mail_test();
  }

  public function solicitud() {
    if (!$this->sistema->isSendEmailSolicitud()) { return true; }

    $subject = self::subjets['solicitud'];
    $s = Solicitud::with(['registros','sede'])->findOrFail($this->solicitud_id);

    $cc_correos = $this->getEmailsCC($s->sede);

    $registros = (new RegistroDias($s->registros))->resumen();
    $info = [
      'sala' => $s->sala->nombre ?? '',
      'registro' => $registros ?? null,
      'motivo' => $s->getMotivo(),
      'comentario' => $s->comentario ?? '',
      'semana_text' => $s->seman->getInfo()
    ];

    $mail = new SolicitudEmail($subject, $info);
    // return $mail;
    $m = Mail::to($this->mail_client);
    if (sizeof($cc_correos) > 0 && !$this->activeDemo()) {
      $m->cc($cc_correos);
    }

    $m->queue($mail);

    return true;
  }

  public function solicitudAprobada() {
    if (!$this->sistema->isSendEmailAceptar()) { return true; }
    $subject = self::subjets['solicitudAprobada'];
    $s = Solicitud::with(['registros','sede','usuario'])->findOrFail($this->solicitud_id);
    $cc_correos = $this->getEmailsCC($s->sede);

    $registros = (new RegistroDias($s->registros))->resumen();
    $info = [
      'sala' => $s->sala->nombre ?? '',
      'registro' => $registros ?? null,
      'motivo' => $s->getMotivo(),
      'comentario' => $s->comentario ?? '',
      'semana_text' => $s->seman->getInfo(),
      'nombre' => $s->usuario->nombre_completo()
    ];

    $mail = new AprobadoEmail($subject, $info);
    // return $mail;
    // return $mail;
    $m = Mail::to($this->mail_client);
    if (sizeof($cc_correos) > 0 && !$this->activeDemo()) {
      $m->cc($cc_correos);
    }

    $m->queue($mail);

    return true;
  }

  public function solicitudRechazada() {
    if (!$this->sistema->isSendEmailRechazado()) { return true; }

    $subject = self::subjets['solicitudRechazada'];
    $s = Solicitud::with(['registros','sede'])->findOrFail($this->solicitud_id);
    $cc_correos = $this->getEmailsCC($s->sede);

    $registros = (new RegistroDias($s->registros))->resumen();
    $info = [
      'sala' => $s->sala->nombre ?? '',
      'registro' => $registros ?? null,
      'motivo' => $s->getMotivo(),
      'comentario' => $s->comentario ?? '',
      'semana_text' => $s->seman->getInfo()
    ];

    $mail = new RechazadoEmail($subject, $info);
    $m = Mail::to($this->mail_client);
    if (sizeof($cc_correos) > 0) {
      $m->cc($cc_correos);
    }

    $m->queue($mail);

    return true;
  }

  public function solicitudCancelado() {
    if (!$this->sistema->isSendEmailCancelar()) { return true; }

    $subject = self::subjets['solicitudCancelada'];
    $s = Solicitud::with(['registros'])->findOrFail($this->solicitud_id);

    $registros = (new RegistroDias($s->registros))->resumen();
    $info = [
      'sala' => $s->sala->nombre ?? '',
      'registro' => $registros ?? null,
      'motivo' => $s->getMotivo(),
      'comentario' => $s->comentario ?? '',
      'semana_text' => $s->seman->getInfo()
    ];

    $mail = new CanceladoEmail($subject, $info);
    Mail::to($this->mail_client)->queue($mail);

    return true;
  }

  // PRIVATE

  private function build_sistema() {
    return Sistema::first();
  }

  private function activeDemo() {
    return $this->sistema->isInfoEmail();
  }

  private function active_mail_test() {
    if ($this->activeDemo()) {
      $email = $this->sistema->getInfoEmailTest();
      if (!empty($email)) {
        $this->mail_client = $email;
      }
    }
  }

  private function getEmailsCC(Sede $sede) {
    $cc_correos = json_decode($sede->getInfoCorreoActivo(), true);

    return array_column($cc_correos, 'correo');
  }
}
