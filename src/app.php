<?php

//src/app.php
// example.com/src/app.php

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

/**
 *    Hello
 */
$routes->add('hello', new Routing\Route('/hello/{name}', array('name' => 'World')));

/**
 *    Bye
 */
$routes->add('bye', new Routing\Route('/bye'));

return $routes;
?>
