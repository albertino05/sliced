<?php

/*include_once 'kint/Kint.class.php';*/
require_once __DIR__ . '/../autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
/* $request = Request::create('/index.php?name=Fabien'); */

$input = $request->get('name', 'World');

$response = new Response(sprintf('Hello %s', htmlspecialchars($input, ENT_QUOTES, 'UTF-8')));

$response->send();
?>
