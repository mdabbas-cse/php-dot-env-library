<?php

namespace DotEnv;

class DotEnv
{
  private static $path = __DIR__ . DIRECTORY_SEPARATOR . '.env';
  private static $env = [];

  public static function setPath($env_path)
  {
    if (self::findFile($env_path)) {
      self::bindEnv();
    }
  }

  private static function findFile($env_path)
  {
    if (!file_exists($env_path)) {
      die($env_path . ' .env file are not found!');
    } else {
      self::$path = $env_path;
      return true;
    }
  }

  private static function isEnvExists()
  {
    if (!file_exists(self::$path))
      die(self::$path . ' .env file are not found!');
  }

  private static function bindEnv()
  {
    $env_file = fopen(self::$path, 'r');
    $file_read = fread($env_file, filesize(self::$path));

    $r = explode("\n", $file_read);

    foreach ($r as $k => $v) {
      if (empty($v)) continue;
      if (substr($v, 0, 1) === '#') continue;
      $exp = explode('=', $v);
      $values = explode('#', $exp[1]);
      $key = trim($exp[0], ' ');
      if (!is_string($key)) continue;
      $val = trim($values[0], ' ');
      self::$env[$key] = $val;
    }
    // dd(self::$env);
  }

  public static function get_env($key)
  {
    self::isEnvExists();
    self::bindEnv();
    if (array_key_exists($key, self::$env)) {
      return self::$env[$key];
    } else {
      die("Env key \"{$key}\" is not exists.");
    }
  }

  public static function set_env()
  {
    $count = func_num_args();
    $argc = func_get_args();
    if ($count === 1) {
      $arr = $argc[0];
      $keys = array_keys($arr);
      while (!empty($keys)) {
        $key = array_pop($keys);
        self::$env[$key] = $arr[$key];
      }
    } else {
      self::$env[$argc[0]] = $argc[1];
    }
  }

  public static function update($key, $updateValue)
  {
    self::isEnvExists();
    self::bindEnv();
    if (array_key_exists($key, self::$env)) {
      file_put_contents(
        self::$path,
        str_replace($key . '=' . self::$env[$key], $key . '=' . $updateValue, file_get_contents(self::$path))
      );
    } else {
      die("\"{$key}\" dose not exists!");
    }
  }
}

function dd($data)
{
  echo '<pre>';
  var_dump($data);
  echo '</pre>';
}
