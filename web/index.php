<?php

include_once 'kint/Kint.class.php';
require_once __DIR__ . '/../autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
/* $request = Request::create('/index.php?name=Fabien'); */

$input = $request->get('name', 'World');


$response = new Response(sprintf('Hello %s', htmlspecialchars($input, ENT_QUOTES, 'UTF-8')));

/**
 * SOME EXAMPLES
 */
$response->setContent('Hello world! - faked');
$response->setStatusCode(200);
$response->headers->set('Content-Type', 'text/html');

// configure the HTTP cache headers
$response->setMaxAge(10000000);

$response->send();
?>
