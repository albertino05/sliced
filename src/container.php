<?php

//src/container.php

use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;

$routes = include __DIR__ . '/routes.php';

$sc = new DependencyInjection\ContainerBuilder();
$sc->register('context', 'Symfony\Component\Routing\RequestContext');

$sc->register('matcher', 'Symfony\Component\Routing\Matcher\UrlMatcher')
        ->setArguments(array($routes, new Reference('context')));

$sc->register('resolver', 'Symfony\Component\HttpKernel\Controller\ControllerResolver');

$sc->register('listener.router', 'Symfony\Component\HttpKernel\EventListener\RouterListener')
        ->setArguments(array(new Reference('matcher')));

//$sc->register('listener.response', 'Symfony\Component\HttpKernel\EventListener\ResponseListener')
//     ->setArguments(array('UTF-8'));
//$sc->register('listener.exception', 'Symfony\Component\HttpKernel\EventListener\ExceptionListener')
//     ->setArguments(array('Calendar\\Controller\\ErrorController::exceptionAction'));

$sc->register('listener.test', 'Sliced\EventDispatcher\Subscribers\Test');
$sc->register('listener.timer', 'Sliced\EventDispatcher\Subscribers\Timer');
//->setArguments(array('Calendar\\Controller\\ErrorController::exceptionAction'));

$sc->register('dispatcher', 'Symfony\Component\EventDispatcher\EventDispatcher')
        ->addMethodCall('addSubscriber', array(new Reference('listener.router')))
        ->addMethodCall('addSubscriber', array(new Reference('listener.test')))
        ->addMethodCall('addSubscriber', array(new Reference('listener.timer')))
;
// ->addMethodCall('addSubscriber', array(new Reference('listener.response')))
// ->addMethodCall('addSubscriber', array(new Reference('listener.exception')))

$sc->register('framework', 'Symfony\Component\HttpKernel\HttpKernel')
        ->setArguments(array(new Reference('dispatcher'), new Reference('resolver')));


return $sc;

// @fix httpcache is cleaning request attributes on handle method(httpEvents::RESPONSE)
//@todo install varnish
$sc->register('httpcache.store', 'Symfony\Component\HttpKernel\HttpCache\Store')
        ->setArguments(array(__DIR__ . '/../src/Sliced/Cache'));

$sc->register('framework.httpcache', 'Symfony\Component\HttpKernel\HttpCache\HttpCache')
        ->setArguments(array(new Reference('framework'), new Reference('httpcache.store')));

?>
