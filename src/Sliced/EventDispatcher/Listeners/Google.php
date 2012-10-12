<?php
// src/Sliced/Listeners/GoogleListener.php
 
namespace Sliced\EventDispatcher\Listeners;

use Sliced\EventDispatcher\Events\ResponseEvent;
 
class Google
{
    public function onResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();
        
        $response->setContent($response->getContent().'GA CODE');
    }
}
?>
