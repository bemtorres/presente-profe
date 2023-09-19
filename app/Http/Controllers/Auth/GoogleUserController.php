<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Auth;
use Exception;
use Laravel\Socialite\Facades\Socialite;

class GoogleUserController extends Controller
{
    /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function redirectToGoogle()
  {
    // $sistema = ModelsSistema::first();
    // if ($sistema->googleEnabled()) {
    return Socialite::driver('google')->redirect();
    // }

    return redirect('/');
  }

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function handleGoogleCallback()
  {
    try {
      // close_sessions();
      $user = Socialite::driver('google')->user();

      // TOKEN
      $token = $user->getId();
      // FOTO
      $foto = $user->getAvatar();
      $nick = $user->getNickname();
      $name = $user->getName();
      // EMAIL
      $email = $user->getEmail();
      $provider = explode("@",$email)[1];

      // return $user->getRaw();



      // // only allow people with @company.com to login
      if($provider == 'duocuc.cl' || $provider == 'profesor.duoc.cl' ){
        // $u = Usuario::findByCorreo($email)->first();
        $u = Usuario::findByCorreo($email)->firstOrFail();

        if (empty($u->inte_google_id())) {
          $integrations = $u->integrations;
          $info = $u->info;

          $integrations['google_id'] = $token;
          $info['img'] = $foto;

          $u->integrations = $integrations;
          $u->info = $info;
          $u->update();
        }

        // return $u;
        // if (empty($u)) {
        //   $u = new Usuario();
        //   $u->nombre = $name;
        //   $u->apellido = "";
        //   $u->correo = $email;
        //   $u->image = $foto;
        //   $u->password = hash('sha256', 'feebacks2000');
        //   $u->cargo = "INGRESO GMAIL";
        //   $u->admin = false;
        //   $u->save();
        // }
        // close_sessions();

        Auth::guard('usuario')->loginUsingId($u->id);

        return redirect()->route('home.index');
      }else {
        return redirect()->route('root')->with('danger','No son cuentas de DuocUC.');
      }
    } catch (\Throwable $e) {

      return $e;
      return redirect()->route('root')->with('danger','No son cuentas de DuocUC.');
      // return redirect('/login')->with('danger','Gmail no responde, comuniquese que atención a clientes.');
    }
  }
}
