<?php

// src/Sliced/EventDispatcher/Subscribers/Menu.php

namespace Sliced\EventDispatcher\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Sliced\EventDispatcher\Events\ResponseEvent;
use Symfony\Component\Routing\Generator\UrlGenerator;

/**
 * 
 * 
  $generator = new Routing\Generator\UrlGenerator($routes, $context);

  echo $generator->generate('hello', array('name' => 'Fabien'));
 * 
 */
class Menu implements EventSubscriberInterface
{

      protected $generator;

      public function __construct($routes, $context)
      {
	  $this->generator = new UrlGenerator($routes, $context);
      }

      public function onResponse(ResponseEvent $event)
      {
	  $links = array();
	  $links[] = $this->generator->generate('hello', array('name' => 'Tino'), true);
	  $links[] = $this->generator->generate('leap_year');
	  $out = '';
	  foreach ($links as $key => $link) {
	        $out .= "<a href='$link'> Link$key </a> <br>";
	  }
	  $response = $event->getResponse();
	  $response->setContent($out . $response->getContent());
      }

      public static function getSubscribedEvents()
      {
	  return array('response' => array('onResponse', -255));
      }

}

?>
