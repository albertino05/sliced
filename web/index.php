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

/*$request = Request::createFromGlobals();*/
$routes = include __DIR__ . '/../src/app.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);
$resolver = new HttpKernel\Controller\ControllerResolver();

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new HttpKernel\EventListener\RouterListener($matcher));

$dispatcher->addSubscriber(new \Sliced\EventDispatcher\Subscribers\Test());
/*$dispatcher->addSubscriber(new \Sliced\EventDispatcher\Subscribers\Menu($routes, $context));*/
/*$dispatcher->addListener('response', array(new Sliced\EventDispatcher\Listeners\Google(), 'onResponse'), -244);*/

$framework = new HttpKernel\HttpKernel($dispatcher, $resolver);
/*$framework = new Sliced\Framework($dispatcher, $resolver);*/
$framework = new HttpCache($framework, new Store(__DIR__.'/../src/Sliced/Cache'),new Esi(), array('debug' => TRUE));
$response = $framework->handle(Request::createFromGlobals());

$response->send();

df(sprintf("loading time: %2.4f ms", (microtime(true) - $time_start)));
?>
