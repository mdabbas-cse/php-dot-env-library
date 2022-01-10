<?php

include_once('bootstrap.php');

use \DotEnv\DotEnv;

$path = __DIR__ . '\.env';

// DotEnv::setPath($path);
envPath($path);

const HOST = 'HOST';
const USER = 'USER';
const PASSWORD = 'PASSWORD';
const DATABASE = 'DATABASE';

// DotEnv::set_env('SSL_KEY', md5(123456));
// echo DotEnv::get_env('SSL_KEY');

DotEnv::set_env(['SERVER' => 'local', 'PORT' => '8080']);
// echo DotEnv::get_env('SERVER');

// setEnv(['SERVER' => 'local', 'PORT' => '8080']);
env('SERVER');

// DotEnv::set_env('HOST', '127.0.0.1'); // reset value temporary

// DotEnv::update('HOST', 'localhost'); // update env value
// DotEnv::get_env('HOST');

envUpdate('HOST', '127.0.0.1'); // update env value
DotEnv::get_env('HOST');

echo "<br>";
echo env('01SKIPPED');

$conn = mysqli_connect(
  env(HOST),
  env(USER),
  env(PASSWORD),
  env(DATABASE)
);

if ($conn) {
  echo 'this is connected';
}
if(is_numeric("123qw4")) echo 'is_numeric("23end")';

