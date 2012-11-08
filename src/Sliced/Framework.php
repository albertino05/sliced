<?php

// src/Sliced/Framework.php

namespace Sliced;

use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Framework extends HttpKernel
{

      protected $container;

      public function __construct(EventDispatcherInterface $dispatcher, ControllerResolverInterface $resolver, ContainerInterface $container)
      {
	  parent::__construct($dispatcher, $resolver);
	  $this->container = $container;
      }

}

?>
