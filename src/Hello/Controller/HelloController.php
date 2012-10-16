<?php

// src/Hello/Controller/HelloController.php

namespace Hello\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloController
{

      function indexAction($name, Request $request)
      {
	 // $response = new Response('name -> ' . $name . rand(0, 100));
	  //$response->setTtl(10);
	  return $name ;
	  //return $response;
      }

}

?>
