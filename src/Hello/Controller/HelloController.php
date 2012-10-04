<?php

// src/Hello/Controller/HelloController.php

namespace Hello\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HelloController
{

      function indexAction($name, Request $request)
      {
	  return new Response('name = ' . $name);
      }

}

?>
