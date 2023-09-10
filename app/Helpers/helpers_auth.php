
<?php

use App\Models\Usuario;

/**
 * session user
 *
 * @return only true
 */
function current_user() {
  return auth('usuario')->user();
}

function close_sessions() {
  if(Auth::guard('usuario')->check()) {
    Auth::guard('usuario')->logout();
  }

  // if(Auth::guard('inscripcion')->check()){
  //   Auth::guard('inscripcion')->logout();
  // }
  // session()->flush();
  // session()->forget('gp_config');
  return true;
}
