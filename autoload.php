<?php

// autoload.php

require_once __DIR__ . '/vendor/symfony/class-loader/Symfony/Component/ClassLoader/UniversalClassLoader.php';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();

/* $loader->registerNamespace('Symfony\\Component\\HttpFoundation', __DIR__ . '/vendor/symfony/http-foundation'); */
/* $loader->registerNamespace('Symfony\\Component\\Routing', __DIR__ . '/vendor/symfony/routing'); */
/* $loader->registerNamespace('Symfony\\Component\\HttpKernel', __DIR__ . '/vendor/symfony/http-kernel'); */
/* $loader->registerNamespace('Symfony\\Component\\EventDispatcher', __DIR__ . '/vendor/symfony/event-dispatcher'); */
/* $loader->registerNamespace('Symfony\\Component\\DependencyInjection', __DIR__ . '/vendor/symfony/dependency-injection'); */

$loader->registerNamespaces(
        array(
	  'Symfony\\Component\\HttpFoundation' => __DIR__ . '/vendor/symfony/http-foundation',
	  'Symfony\\Component\\Routing' => __DIR__ . '/vendor/symfony/routing',
	  'Symfony\\Component\\HttpKernel' => __DIR__ . '/vendor/symfony/http-kernel',
	  'Symfony\\Component\\EventDispatcher' => __DIR__ . '/vendor/symfony/event-dispatcher',
	  'Symfony\\Component\\DependencyInjection' => __DIR__ . '/vendor/symfony/dependency-injection',
	  'Symfony\\Component\\Config' => __DIR__ . '/vendor/symfony/config',
        )
);

$loader->registerNamespaceFallback(__DIR__ . '/src');
$loader->registerNamespaceFallback(__DIR__ . '/app');

$loader->register();
?>
