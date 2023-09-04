<?php

/**
* verify if gmail is active
*
* @return boolean status
*/
function helper_integration_gmail(){
  return env('GOOGLE_ACTIVE', false);
}
