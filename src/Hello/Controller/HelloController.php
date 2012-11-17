<?php

// src/Hello/Controller/HelloController.php

namespace Hello\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sliced\Controller;

class HelloController extends Controller
{

      function indexAction($name, Request $request)
      {
	  //throw new \Exception; return;
	  
	  $response = new Response($name . ' ! ' . rand(0, 100) . '<br>');
/*
	  $response->setPublic();
	  $response->setETag('tino');

	  if ($response->isNotModified($request)) {
	        return $response;
	  }
*/
	  return $response;
      }

}

?>
