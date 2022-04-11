<?php

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Ludi;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class LudiSubscribe implements EventSubscriberInterface
{
    private $security;
    private $em;

    public function __construct(Security $security, EntityManagerInterface $em){
        $this->security = $security;
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['createLudi', EventPriorities::PRE_WRITE]
        ];
    }

    public function createLudi(ViewEvent $event){
        $ludi = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        $user = $this->security->getUser();

        if($ludi instanceof Ludi && $method === "POST"){
            $nom = $ludi->getNom();
            $specialite = $ludi->getSpecialite();

                $ludi->setUser($user)
                    ->setNom($nom)
                    ->setSpecialite($specialite)
                    ->setComplet(false);
                $user->setBourse() -60;

            $this->em->persist($user);
            $this->em->flush();
        }
    }
}