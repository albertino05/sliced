<?php

$time_start = microtime(true);
// web/index.php

include_once 'kint/Kint.class.php';
require_once __DIR__ . '/../autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;

$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../src/app.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

try {
      $request->attributes->add($matcher->match($request->getPathInfo()));
      
      $resolver = new HttpKernel\Controller\ControllerResolver();
      $controller = $resolver->getController($request);
      $arguments = $resolver->getArguments($request, $controller);

      $response = call_user_func_array($controller, $arguments);
} catch (Routing\Exception\ResourceNotFoundException $e) {
      $response = new Response('Not Found', 404);
} catch (Exception $e) {
      d($e);
      $response = new Response('An error occurred', 500);
}

$response->send();

printf("<hr> loading time: %2.4f ", (microtime(true) - $time_start));
?>
