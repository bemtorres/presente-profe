<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordEmail;
use App\Models\Usuario;
use App\Models\UsuarioInvitado;
use App\Services\EmailUser;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


// use App\Http\Requests\AuthLoginRequest as AuthRequest;

class AuthController extends Controller
{
  public function index() {
    return view('auth.index');
  }


  public function registro() {
    return view('auth.registro');
  }

  // public function home() {
  //   return view('blank');
  // }

  public function login(Request $request){
    try {
      $u = Usuario::findByCorreo($request->correo)->firstOrFail();
      $pass =  hash('sha256', $request->password);
      if($u->password==$pass){
        Auth::guard('usuario')->loginUsingId($u->id, true);
        if ($u->perfil == 1) {
          return redirect()->route('admin.index');
        } else if ($u->perfil == 2) {
          return redirect()->route('webappdocente.index');
        } else {
          return redirect()->route('webappalumno.index');
        }
      }else{
        return back()->with('info','Error. Intente nuevamente.');
      }
    } catch (\Throwable $th) {
      return back()->with('info','Error. Intente nuevamente.');
    }
  }

  public function registroStore(Request $request) {
    $codigo = $request->input('codigo');

    $codigo = Str::lower($request->input('codigo'));

    if ($codigo == "presenteprofe") {
      $usuario_main = Usuario::first();
    } else {
      $usuario_main = Usuario::findCodeInvitacion($codigo)->firstOrFail();
    }

    $exist = Usuario::findByCorreo($request->correo)->first();

    if ($usuario_main->getInfoInvitar() || $codigo == "presenteprofe") {
      if (empty($exist)) {
        $codigo =  Str::random(8);

        $u = new Usuario();
        $u->run = $request->input('run');
        $u->nombre = $request->input('nombre');
        $u->apellido = $request->input('apellido');
        $u->correo = $request->input('correo');
        $u->password = hash('sha256', $codigo);

        if ($request->input('perfil') == 'docente') {
          $u->perfil = 2;
        } else{
          $u->perfil = 3;
        }

        $u->save();



        $info = $usuario_main->info;
        $info['invitar_count'] = $usuario_main->getInfoInvitarCount() + 1;
        $usuario_main->info = $info;
        $usuario_main->update();

        $uinvitado = new UsuarioInvitado();
        $uinvitado->id_usuario = $usuario_main->id;
        $uinvitado->id_invitado = $u->id;
        $uinvitado->save();

        (new EmailUser($u, $codigo))->registro();

        return redirect()->route('root')->with('success','Se ha enviado correo a su cuenta.');
      } else {
        return back()->with('info','Correo ya esta registrado.');
      }
    } else {
      return back()->with('info','Codigo de invitacion no valido.');
    }

    return view('auth.registro');
  }


  public function recuperar() {
    return view('auth.recuperar');
  }

  public function recuperarStore(Request $request) {
    try {
      $u = Usuario::findByCorreo($request->correo)->firstOrFail();

      $time = time() + 60*60*24;

      $u->password = hash('sha256', $time);
      $u->save();

      // (new EmailUser($u, $time))->password_reset();

      $info = [
        'nombre' => $u->nombre_completo() ?? '',
        'password' => $time,
        'email' => $u->correo ?? '',
      ];

      $mail = new ResetPasswordEmail('🔑 RECUPERACION DE CREDENCIALES 🔑', $info);
      $m = Mail::to($u->correo)->queue($mail);

      return back()->with('success','Se ha cambiado la contraseña correctamente.');
    } catch (\Throwable $th) {
      return back()->with('info','Error. Intente nuevamente.');
    }
  }

  public function logout(){
    close_sessions();
    return redirect()->route('root');
  }

  // public function start_sesions($u) {
  //   $config = Config::first();
  //   $sistema = Sistema::first();

  //   session([
  //     'gp_config' => $config,
  //     'gp_sistema' => $sistema
  //   ]);

  //   return true;
  // }
}
