<?php

//src/app.php
// example.com/src/app.php

use Symfony\Component\Routing;

$cached_matcher = __DIR__ . '/cache/cached_matcher.php';

if (file_exists($cached_matcher)&& !$debug) {
      require_once $cached_matcher;
      return;
}

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

$dumper = new Routing\Matcher\Dumper\PhpMatcherDumper($routes);
file_put_contents($cached_matcher, $dumper->dump(array('class' => 'cached_matcher')));

require_once $cached_matcher;
return;
?>
