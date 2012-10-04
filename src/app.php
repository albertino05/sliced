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
	  '_controller' => 'HelloController::indexAction',
        )));

class HelloController{
      function indexAction($name, \Symfony\Component\HttpFoundation\Request $request){
	  d($request);
	  return new Symfony\Component\HttpFoundation\Response('name = ' . $name);
      }
}

/**
 *    Bye
 */
$routes->add('bye', new Routing\Route('/bye'));

return $routes;
?>
