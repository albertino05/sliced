<?php

namespace Sliced;

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher as baseUrlMatcher;

/**
 * UrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class UrlMatcher extends baseUrlMatcher
{

      /**
       * Constructor.
       */
      public function __construct(RequestContext $context)
      {
	  $this->context = $context;
      }

      public function match($pathinfo)
      {
	  $allow = array();
	  $pathinfo = rawurldecode($pathinfo);

	  // hello
	  if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello(?:/(?<name>[^/]+))?$#s', $pathinfo, $matches)) {
	        return array_merge($this->mergeDefaults($matches, array('name' => 'World', '_controller' => 'Hello\\Controller\\HelloController::indexAction',)), array('_route' => 'hello'));
	  }

	  // leap_year
	  if (0 === strpos($pathinfo, '/is_leap_year') && preg_match('#^/is_leap_year(?:/(?<year>[^/]+))?$#s', $pathinfo, $matches)) {
	        return array_merge($this->mergeDefaults($matches, array('year' => NULL, '_controller' => 'Calendar\\Controller\\LeapYearController::indexAction',)), array('_route' => 'leap_year'));
	  }

	  throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
      }

}

?>
