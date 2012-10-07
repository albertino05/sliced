<?php

// example.com/src/Sliced/TestListener.php

namespace Sliced;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TestListener implements EventSubscriberInterface
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
		array('onResponse', -5),
		array('ini', -12)
	      ),
	      'headers' => array(
		array('setHeader'),
	      )
	  );
      }

}

?>
