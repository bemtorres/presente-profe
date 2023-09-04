<?php

use App\Services\ConvertDatetime;
use App\Services\Currency;

function activeValidate($urls, $blockers) {
  $status = false;
  foreach ($urls as $key => $url) {
    if (request()->is($url)) { $status = true; }
    if (sizeof($blockers) > 0) {
      foreach ($blockers as $keyIn => $valueIn) {
        if (request()->is($valueIn)) {
          $status = false;
        }
      }
    }
  }
  return $status;
}

function activeTab($urls, $blockers = array()){
  return activeValidate($urls, $blockers) ? 'active' : '';
}

function activeOpen($urls, $blockers = array()){
  return activeValidate($urls, $blockers) ? 'menu-open' : '';
}

function helperDateFormat(string $date) {
  return (new ConvertDatetime($date));
}

function helperMoney(string $m) {
  return Currency::getConvert($m);
}
