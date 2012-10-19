<?php

//src/app.php
// example.com/src/app.php

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

/**
 *    Hello
 */
$routes->add('hello', new Routing\Route('/hello/{name}', array(
	  'name' => 'World',
	  '_controller' => 'Hello\\Controller\\HelloController::indexAction',
        )));

/**
 *    Leap Year
 */
$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', array(
	  'year' => null,
	  '_controller' => 'Calendar\\Controller\\LeapYearController::indexAction',
        )));

return $routes;
?>
