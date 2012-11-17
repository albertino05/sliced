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
	  $this->startTime = $startTime;
      }

      /**
       * 
       * @param \Symfony\Component\HttpKernel\Event\PostResponseEvent $event
       */
      public function onTerminate(Event\PostResponseEvent $event)
      {
	  echo '<br>' . __FUNCTION__ . '<br>';

	  /* $startTime = $event->getRequest()->attributes->get('startTime'); */
	  $startTime = $event->getRequest()->attributes->get('startTime');
	  $startTime = $this->startTime;
	  $runTime = microtime(true) - $startTime;
	  $output = sprintf("loading time: %2.3f ms <hr />", $runTime);
	  echo $output;
      }

      public function onController(Event\FilterControllerEvent $event)
      {
	  echo '<br>' . __FUNCTION__ . '<br>';

	  $startTime = $event->getRequest()->attributes->get('startTime');
	  $runTime = microtime(true) - $startTime;
	  $output = sprintf("loading time: %2.3f ms<hr /> ", $runTime);
	  echo $output;
      }

      public function onView(Event\GetResponseForControllerResultEvent $event)
      {
	  echo '<br>' . __FUNCTION__ . '<br>';

	  $startTime = $event->getRequest()->attributes->get('startTime');
	  $runTime = microtime(true) - $startTime;
	  $output = sprintf("loading time: %2.3f ms <hr />", $runTime);
	  echo $output;
	  $x = $event->getControllerResult();
	  $x = '<h1>' . $x . '</h1>';
	  $event->setResponse(new \Symfony\Component\HttpFoundation\Response($x));
      }

      public function onResponse(Event\FilterResponseEvent $event)
      {
	  echo '<br>' . __FUNCTION__ . '<br>';
	  $startTime = $event->getRequest()->attributes->get('startTime');
	  $runTime = microtime(true) - $startTime;
	  $output = sprintf("loading time: %2.3f ms <hr />", $runTime);
	  echo $output;
      }
      public function onException(Event\GetResponseForExceptionEvent $event)
      {
	  echo '<br>' . __FUNCTION__ . '<br>';
	  $startTime = $event->getRequest()->attributes->get('startTime');
	  $runTime = microtime(true) - $startTime;
	  $output = sprintf("loading time: %2.3f ms <hr />", $runTime);
	  echo $output;
	  $event->setResponse(new \Symfony\Component\HttpFoundation\Response('erro no kernel'));
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
	      HttpKernel\KernelEvents::VIEW => array(
		array('onView', -200)
	      ),
	      HttpKernel\KernelEvents::CONTROLLER => array(
		array('onController', -200)
	      ),
	      HttpKernel\KernelEvents::RESPONSE => array(
		array('onResponse', -200)
	      ),
	      HttpKernel\KernelEvents::EXCEPTION => array(
		array('onException', -200)
	      ),
	  );
      }

}

?>
