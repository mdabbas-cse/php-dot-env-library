<?php

define('ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
include_once(ROOT. DS . 'Helpers' . DS . 'custom.php');

function autoload($filename)
{
  $file = ROOT . DS . $filename . '.php';
  if (file_exists($file)) {
    require_once($file);
  } else {
    throw new Error( $file . ' not exists');
  }
}

spl_autoload_register('autoload');