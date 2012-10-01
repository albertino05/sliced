<?php

// web/index.php

include_once 'kint/Kint.class.php';
require_once __DIR__ . '/../autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;

$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../src/app.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

try {
      extract($matcher->match($request->getPathInfo()), EXTR_SKIP);
      ob_start();

      $response = new Response(ob_get_clean());
} catch (Routing\Exception\ResourceNotFoundException $e) {
      $response = new Response('Not Found', 404);
} catch (Exception $e) {
      $response = new Response('An error occurred', 500);
}

$response->send();
?>
