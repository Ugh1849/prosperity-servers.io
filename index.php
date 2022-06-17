<?php

if( session_status() === PHP_SESSION_NONE ){
    session_start();
}

define("BASE_PATH", __DIR__);
define("FULL_URL", (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

require BASE_PATH . "/config.php";

// Dev mode
// ini_set('display_errors', 1);

// Application
require BASE_PATH . "/app/Autoloader.php";
require BASE_PATH . "/app/Functions.php";

$app = new App\Autoloader();
$app->load();