<?php

// src/Sliced/EventDispatcher/Subscribers/Test.php

namespace Sliced\EventDispatcher\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel;
use Symfony\Component\HttpFoundation\Response;

class Test implements EventSubscriberInterface
{

      /**
       * 
       * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
       * 
       *  if http cache is set(like time to live) this is NOT executed
       */
      public function onRequest(HttpKernel\Event\GetResponseEvent $event)
      {
	  /* echo 'neco'; */
      }

      /**
       * 
       * @param \Symfony\Component\HttpKernel\Event\FilterResponseEvent $event
       * 
       * Executed on response, if http cache is set(like time to live) this is NOT executed
       */
      public function onResponse(HttpKernel\Event\FilterResponseEvent $event)
      {
	  /* d($event->getName()); */
	 // echo 'response';
      }

      /**
       * 
       * @param \Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent $event
       * 
       * For this to be executed controller need NOT return a Response
       * Like the above when cached this is NOT executed
       */
      public function onView(HttpKernel\Event\GetResponseForControllerResultEvent $event)
      {
	  $response = new Response($event->getControllerResult());
	  $response->setContent('<h1> ' . $response->getContent() . ' </h1>');

/*	  $date = new \DateTime();*/
	  /*$date->modify('+20 seconds');*/
	  /*$response->setExpires($date);*/
	  /*$response->setPrivate();*/
	  
	  //$response->setMaxAge(30);

	  //$response->setSharedMaxAge(30);
	  
	  $response->setEtag(md5($response->getContent()));
	  
	  $response->setPublic();
	  
	  $response->isNotModified($event->getRequest());

	  df($response->getStatusCode());
	  $event->setResponse($response);
      }

      /**
       * 
       * @return array The event names to listen to
       * positive are first executed
       * negative are executed last
       */
      public static function getSubscribedEvents()
      {
	  return array(
	      HttpKernel\KernelEvents::REQUEST => array(
		array('onRequest', -255)
	      ),
	      HttpKernel\KernelEvents::RESPONSE => array(
		array('onResponse', -5),
	      ),
	      HttpKernel\KernelEvents::VIEW => array(
		array('onView'),
	      )
	  );
      }

}

?>
