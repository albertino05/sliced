<?php

ini_set('display_errors', 1);
error_reporting(-1);
// web/index.php
require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;

if (isset($_SERVER['HTTP_CLIENT_IP'])
        || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
        || !in_array(@$_SERVER['REMOTE_ADDR'], array(
	  '127.0.0.1',
	  '::1',
        ))
) {
      $debug = FALSE;
} else {
      require_once 'kint/kint.php';
      $debug = TRUE;
      /* $debug = false; */
}

$sc = require_once __DIR__ . '/../app/container.php';

$request = Request::createFromGlobals();

$response = $sc->get('http_kernel.cache')->handle($request);
$response->send();
$sc->get('http_kernel.cache')->terminate($request, $response);
?>
