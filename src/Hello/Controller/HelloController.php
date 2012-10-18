<?php

// src/Hello/Controller/HelloController.php

namespace Hello\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloController
{

      function indexAction($name, Request $request)
      {
	  $response =  new Response($name . ' ! ' . rand(0,10) );
	 $response->setTtl(20);
	  return $response;
      }

}

?>
