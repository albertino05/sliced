<?php

// src/Sliced/EventDispatcher/Subscribers/Test.php

namespace Sliced\EventDispatcher\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel;
use Symfony\Component\HttpFoundation\Response;

/**
 *    Subscrive to this event to test all the kernel dispatchers
 * 
 */
class Test implements EventSubscriberInterface
{

      /**
       * 
       * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
       */
      public function onRequest(HttpKernel\Event\GetResponseEvent $event)
      {
	  /*d($event->getRequest());*/
      }

      /**
       * 
       * @param \Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent $event
       */
      public function onException(HttpKernel\Event\GetResponseForExceptionEvent $event)
      {
	  // df('onException');
	  $response = new Response($event->getException()->getMessage());
	  $event->setResponse($response);
      }

      /**
       * 
       * @param \Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent $event
       */
      public function onView(HttpKernel\Event\GetResponseForControllerResultEvent $event)
      {
	  //df('onView');
	  $response = new Response($event->getControllerResult());

	  $response->setEtag(md5($response->getContent()));
	  $response->setPublic();
	  $response->isNotModified($event->getRequest());

	  $event->setResponse($response);
      }

      public function onController(HttpKernel\Event\FilterControllerEvent $event)
      {
	  /*d($event->getRequest()->attributes->all());*/
      }

      /**
       * 
       * @param \Symfony\Component\HttpKernel\Event\FilterResponseEvent $event
       */
      public function onResponse(HttpKernel\Event\FilterResponseEvent $event)
      {
	  /*d($event->getRequest()->attributes->all());*/
      }

      /**
       * 
       * @param \Symfony\Component\HttpKernel\Event\PostResponseEvent $event
       */
      public function onTerminate(HttpKernel\Event\PostResponseEvent $event)
      {
	   /*d($event->getRequest()->attributes->all());*/
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
		array('onRequest', 20)
	      ),
	      HttpKernel\KernelEvents::EXCEPTION => array(
		array('onException', 56)
	      ),
	      HttpKernel\KernelEvents::VIEW => array(
		array('onView', -5),
	      ),
	      HttpKernel\KernelEvents::CONTROLLER => array(
		array('onController'),
	      ),
	      HttpKernel\KernelEvents::RESPONSE => array(
		array('onResponse', -55)
	      ),
	      HttpKernel\KernelEvents::TERMINATE => array(
		array('onTerminate', -250)
	      ),
	  );
      }

}

?>
