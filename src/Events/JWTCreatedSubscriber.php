<?php

namespace App\Events;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedSubscriber
{
    public function updateJwtData(JWTCreatedEvent $event)
    {
        $user = $event->getUser();
        $data = $event->getData();
        $data['firstName'] = $user->getNom();
        $data['lastName'] = $user->getPrenom();
        $data['id'] = $user->getId();
        $event->setData($data);
    }
}