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
	  $response =  new Response($name . ' ! ' . rand(0,100) );
	 $response->setTtl(20);
	  return $response;
      }

}

?>
