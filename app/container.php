<?php

//src/container.php

use Symfony\Component\DependencyInjection;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

include __DIR__ . '/routes.php';

$file = __DIR__ . '/cache/cached_container.php';

if (file_exists($file) && !$debug) {
      require_once $file;
      return new cached_container();
}
d('tino');
$parameterBag = new DependencyInjection\ParameterBag\ParameterBag();
$parameterBag->set('debug', $debug);
$parameterBag->set('context_class', 'Symfony\Component\Routing\RequestContext');
$parameterBag->set('matcher_class', 'Symfony\Component\Routing\Matcher\UrlMatcher');
$parameterBag->set('matcher_class_optimized', 'cached_matcher');
$parameterBag->set('resolver_class', 'Symfony\Component\HttpKernel\Controller\ControllerResolver');

$sc = new DependencyInjection\ContainerBuilder($parameterBag);

$loader = new YamlFileLoader($sc, new FileLocator(__DIR__));
$loader->load('services.yml');

$sc->register('context', '%context_class%');

$sc->register('matcher', '%matcher_class_optimized%')
        ->setArguments(array(new Reference('context')))
;
//$sc->register('matcher', '%matcher_class%')
//      ->setArguments(array($routes, new Reference('context')))
/* ->setArguments(array(new Reference('context'))) */

$sc->register('resolver', '%resolver_class%');

/*$sc->register('listener.router', 'Symfony\Component\HttpKernel\EventListener\RouterListener')*/
        /*->setArguments(array(new Reference('matcher')));*/

//$sc->register('listener.response', 'Symfony\Component\HttpKernel\EventListener\ResponseListener')
//     ->setArguments(array('UTF-8'));
//$sc->register('listener.exception', 'Symfony\Component\HttpKernel\EventListener\ExceptionListener')
//     ->setArguments(array('Calendar\\Controller\\ErrorController::exceptionAction'));

/* $sc->register('listener.test', 'Sliced\EventDispatcher\Subscribers\Test'); */
/*$sc->register('listener.timer', 'Sliced\EventDispatcher\Subscribers\Timer');*/


/*$sc->register('dispatcher', 'Symfony\Component\EventDispatcher\EventDispatcher')*/
        /*->addMethodCall('addSubscriber', array(new Reference('listener.router')))*/
        //->addMethodCall('addSubscriber', array(new Reference('listener.test')))
        /*->addMethodCall('addSubscriber', array(new Reference('listener.timer')))*/
;
// ->addMethodCall('addSubscriber', array(new Reference('listener.response')))
// ->addMethodCall('addSubscriber', array(new Reference('listener.exception')))

/* $sc->register('http_kernel', 'Symfony\Component\HttpKernel\HttpKernel') */
$sc->register('http_kernel', 'Symfony\Component\HttpKernel\HttpKernel')
        ->setArguments(array(new Reference('dispatcher'), new Reference('resolver')));



// @fix httpcache is cleaning request attributes on handle method(httpEvents::RESPONSE)
//@todo install varnish
$sc->register('httpcache.store', 'Symfony\Component\HttpKernel\HttpCache\Store')
        ->setArguments(array(__DIR__ . '/cache/httpcache'));
;

$sc->register('http_kernel.cache', 'Symfony\Component\HttpKernel\HttpCache\HttpCache')
        ->setArguments(array(new Reference('http_kernel'), new Reference('httpcache.store')));


/* $calendar_container = require_once __DIR__. '/../src/Calendar/Container/Container.php'; */
/* $sc->merge($calendar_container); */
//$sc->merge(require_once __DIR__. '/../src/Calendar/Container/Container.php');

$sc->compile();

$dumper = new PhpDumper($sc);
file_put_contents($file, $dumper->dump(array('class' => 'cached_container')));

return $sc;
?>
