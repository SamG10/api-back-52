<?php

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Ludi;
use App\Repository\LudiRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class LudiSubscribe implements EventSubscriberInterface{
    private $security;
    private $em;
    private $repository;

    public function __construct(Security $security,LudiRepository $repository, EntityManagerInterface $em){
        $this->security = $security;
        $this->repository = $repository;
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
        $rest = $user->getBourse() - 60 ;

        if($ludi instanceof Ludi && $method === "POST"){
            $ludis = $this->repository->findBy(["user" => $user]);
            $ludi->setComplet(false)
               ->setUser($user);
            if(!empty($ludis) && $rest >= 0){
               $user->setBourse($rest);
               $this->em->persist($user);
               $this->em->flush();
            } elseif ($rest < 0){
               throw new \Exception("Vous n'avez pas assez d'argent");
            }
        }
    }
}