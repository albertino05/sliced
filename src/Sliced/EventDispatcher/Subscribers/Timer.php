<?php

// src/Sliced/EventDispatcher/Subscribers/Test.php

namespace Sliced\EventDispatcher\Subscribers;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event;
use Symfony\Component\HttpKernel;
use Symfony\Component\HttpFoundation\Request;

/**
 *    Subscrive to this event to test all the kernel dispatchers
 * 
 */
class Timer implements EventSubscriberInterface
{

      protected $startTime;

      /**
       * 
       * @param \Symfony\Component\HttpKernel\Event\GetResponseEvent $event
       */
      public function onRequest(Event\GetResponseEvent $event)
      {
	  $request = $event->getRequest();
	  $startTime = microtime(true);
	  $request->attributes->set('startTime', $startTime);
	  $this->startTime=$startTime;
      }

      /**
       * 
       * @param \Symfony\Component\HttpKernel\Event\PostResponseEvent $event
       */
      public function onTerminate(Event\PostResponseEvent $event)
      {
	  /*$startTime = $event->getRequest()->attributes->get('startTime');*/
	  $startTime = $event->getRequest()->attributes->get('startTime');
	  $runTime = microtime(true) - $startTime;
	  $output = sprintf("<hr />loading time: %2.4f ms ", $runTime);
	  echo $output;
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
		array('onRequest', 200)
	      ),
	      HttpKernel\KernelEvents::TERMINATE => array(
		array('onTerminate', -200)
	      ),
	  );
      }

}

?>
