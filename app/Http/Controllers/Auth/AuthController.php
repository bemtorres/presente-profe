<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Auth;
use Illuminate\Http\Request;


// use App\Http\Requests\AuthLoginRequest as AuthRequest;

class AuthController extends Controller
{
  public function index() {
    return view('auth.index');
  }

  public function home() {
    return view('blank');
  }

  public function login(Request $request){
    try {
      $u = Usuario::findByCorreo($request->correo)->firstOrFail();

      $pass =  hash('sha256', $request->password);
      if($u->password==$pass){

        Auth::guard('usuario')->loginUsingId($u->id);
        // $this->start_sesions($u);

        return redirect()->route('home.index');
        // if ($u->admin) {
        // }
        // return redirect()->route('login');
      }else{
        return back()->with('info','Error. Intente nuevamente.');
      }
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
