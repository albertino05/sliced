<?php

// framework/autoload.php

require_once __DIR__ . '/vendor/symfony/class-loader/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();

$loader->registerNamespace('Symfony\\Component\\HttpFoundation', __DIR__ . '/vendor/symfony/http-foundation');

$loader->registerNamespace('Symfony\\Component\\Routing', __DIR__ . '/vendor/symfony/routing');

$loader->registerNamespace('Symfony\\Component\\HttpKernel', __DIR__ . '/vendor/symfony/http-kernel');

//$loader->registerNamespace('Sliced', __DIR__ . '/src');

/**
 *    Here starts specific app namespaces
 */

//    Hello -> test namespace
//$loader->registerNamespace('Hello', __DIR__ . '/src');

// LeapYear -> another test namespace
$loader->registerNamespaceFallback(__DIR__ . '/src');

$loader->register();

?>
