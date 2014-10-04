<?php
/**
 * 03/10/2014
 * open-skool
 */

namespace Manuelj555\Bundle\AjaxFlashBundle\EventListener;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

/**
 * @autor Manuel Aguirre <programador.manuel@gmail.com>
 */
class PrepareFlashesListener
{

    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (!$event->getRequest()->hasSession()) {
            return;
        }

        $session = $event->getRequest()->getSession();

        if (!$session instanceof Session) {
            return;
        }

        $flashes = $session->getFlashBag()->all();

        if (!count($flashes)) {
            return;
        }

        $formatted = array();

        foreach ($flashes as $type => $messages) {
            $formatted[$type] = $messages;
        }

        $event->getResponse()
            ->headers
            ->set('X-Ajax-Flash', json_encode($formatted));
    }
} 