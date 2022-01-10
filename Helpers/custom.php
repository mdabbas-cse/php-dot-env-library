<?php

use DotEnv\DotEnv;

if (!function_exists('envPath')) {
  function envPath($path)
  {
    return DotEnv::setPath($path);
  }
}

if (!function_exists('env')) {
  function env($key)
  {
    return DotEnv::get_env($key);
  }
}

if (!function_exists('setEnv')) {
  function setEnv(...$arr)
  {
    // $args = func_get_args();
    return DotEnv::set_env($arr[0]);
  }
}

if (!function_exists('envUpdate')) {
  function envUpdate($key, $val)
  {
    return DotEnv::update($key, $val);
  }
}
