<?php

// web/index.php
require_once 'kint/kint.php';
require_once __DIR__ . '/../autoload.php';

use Symfony\Component\HttpFoundation\Request;

$sc = require_once __DIR__ . '/../src/container.php';

$request = Request::createFromGlobals();

$response = $sc->get('http_kernel')->handle($request);
$response->send();
$sc->get('http_kernel')->terminate($request, $response);
?>
