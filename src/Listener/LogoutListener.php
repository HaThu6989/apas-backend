<?php

namespace App\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Event\LogoutEvent;

class LogoutListener
{
    public function onLogout(LogoutEvent $logoutEvent): void
    {
        $logoutEvent->setResponse(new JsonResponse([]));
    }
}
