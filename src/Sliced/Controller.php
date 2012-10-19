<?php

//src/Sliced/Controller.php

namespace Sliced;

use Symfony\Component\DependencyInjection\ContainerAware;

class Controller extends ContainerAware
{

      function getContainer()
      {
	  return $this->container;
      }

}

?>
