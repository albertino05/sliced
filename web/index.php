<?php

include_once 'kint/Kint.class.php';
require_once __DIR__ . '/../autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$request = Request::createFromGlobals();
/* $request = Request::create('/index.php?name=Fabien'); */

$input = $request->get('name', 'World');

/**
 * SOME EXAMPLES
 */
// the URI being requested (e.g. /about) minus any query parameters
d($request->getPathInfo());

// retrieve GET and POST variables respectively
d($request->query->get('foo'));
d($request->request->get('bar', 'default value if bar does not exist'));

// retrieve SERVER variables
d($request->server->get('HTTP_HOST'));

// retrieves an instance of UploadedFile identified by foo
d($request->files->get('foo'));

// retrieve a COOKIE value
d($request->cookies->get('PHPSESSID'));

// retrieve an HTTP request header, with normalized, lowercase keys
d($request->headers->get('host'));
d($request->headers->get('content_type'));

 // GET, POST, PUT, DELETE, HEAD
d($request->getMethod());

// an array of languages the client accepts
d($request->getLanguages());


$response = new Response(sprintf('Hello %s', htmlspecialchars($input, ENT_QUOTES, 'UTF-8')));

$response->send();
?>
