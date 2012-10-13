<?php

// src/Sliced/EventDispatcher/Subscribers/Test.php

namespace Sliced\EventDispatcher\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Sliced\EventDispatcher\Events\ResponseEvent;

class Test implements EventSubscriberInterface
{

      public function onResponse(ResponseEvent $event)
      {
	  $response = $event->getResponse();
	  $response->setContent('<h5>before</h5>' . $response->getContent() . '<h5>after</h5>');
      }

      public function ini(ResponseEvent $event)
      {
	  $response = $event->getResponse();
	  $response->setContent('<h5>antes</h5>' . $response->getContent() . '<h5>depois</h5>');
	  //$event->stopPropagation();
      }

      public function setHeader(ResponseEvent $event)
      {
	  $response = $event->getResponse();
	  $headers = $response->headers;
	  $headers->set('test', 'motherfucker');
	  
      }

      public static function getSubscribedEvents()
      {
	  /* return array('response' => 'onResponse'); */
	  return array(
	      'response' => array(
		array('onResponse', -5),//negative is after
		array('ini', 3) //positive is before
	      ),
	      'headers' => array(
		array('setHeader'),
	      )
	  );
      }

}

?>
