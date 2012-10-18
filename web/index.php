<?php

$time_start = microtime(true);
// web/index.php

include_once 'kint/Kint.class.php';
require_once __DIR__ . '/../autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Symfony\Component\HttpKernel\HttpCache\Esi;

$routes = include __DIR__ . '/../src/app.php';

$request = Request::createFromGlobals();

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$resolver = new HttpKernel\Controller\ControllerResolver();

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new HttpKernel\EventListener\RouterListener($matcher));

$dispatcher->addSubscriber(new \Sliced\EventDispatcher\Subscribers\Test());
/*$dispatcher->addSubscriber(new \Sliced\EventDispatcher\Subscribers\Menu($routes, $context));*/

$framework = new HttpKernel\HttpKernel($dispatcher, $resolver);
$framework = new HttpCache($framework, new Store(__DIR__.'/../src/Sliced/Cache'),new Esi(), array('debug' => false));

$response = $framework->handle($request);
$response->send();

$framework->terminate($request, $response);

printf("<hr>loading time:<b> %2.4f ms </b>", (microtime(true) - $time_start));
?>
