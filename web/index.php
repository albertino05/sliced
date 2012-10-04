<?php

$time_start = microtime(true);
// web/index.php

include_once 'kint/Kint.class.php';
require_once __DIR__ . '/../autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;

$request = Request::createFromGlobals();
$routes = include __DIR__ . '/../src/app.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$resolver = new HttpKernel\Controller\ControllerResolver();

$dispatcher = new EventDispatcher();
$dispatcher->addListener('response', function (Sliced\ResponseEvent $event) {
	    $response = $event->getResponse();
	    $response->setContent('<h5> before </h5>'.$response->getContent() . '<h5> after </h5>');
	    $headers = $response->headers;
	    $headers->set('Test-Header', 'tst');
        });

$framework = new Sliced\Framework($dispatcher, $matcher, $resolver);
$response = $framework->handle($request);

$response->send();

printf("<hr> loading time: <b> %2.4f </b> ms", (microtime(true) - $time_start));
?>
