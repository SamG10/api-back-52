<?php

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\Gladiateur;
use App\Repository\GladiateurRepository;
use App\Repository\LudiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Security;

class GladiateurSubscribe implements EventSubscriberInterface
{
    private $security;
    private $em;
    private $repository;
    private $ludiRepository;

    public function __construct(Security $security, GladiateurRepository $repository, EntityManagerInterface $em, LudiRepository $ludiRepository)
    {
        $this->security = $security;
        $this->repository = $repository;
        $this->em = $em;
        $this->ludiRepository = $ludiRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['createGladiateur', EventPriorities::PRE_WRITE]
        ];
    }

    public function createGladiateur(ViewEvent $event)
    {
        $gladiateur = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();


        if ($gladiateur instanceof Gladiateur && $method === "POST") {
            $user = $this->security->getUser();
            $getLudi = $gladiateur->getLudi();
            $ludi = $this->ludiRepository->findBy(["user" => $user, "id" => $getLudi->getId(), "complet" => false]);
            $rest = $user->getBourse() - 5;
            $full = $this->repository->findBy(["ludi" => $getLudi]);

            if (!empty($ludi)) {
                if ($rest >= 0) {
                    $adresse = rand(0, 3);
                    $strength = rand(0, 3);
                    $equilibre = rand(0, 3);
                    $vitesse = rand(0, 3);
                    $strategie = rand(0, 3);

                    $gladiateur->setAdresse($adresse)
                        ->setStrength($strength)
                        ->setEquilibre($equilibre)
                        ->setVitesse($vitesse)
                        ->setStrategie($strategie);

                    if (count($full) === 9) {
                        $ludi[0]->setComplet(true);
                        $this->em->persist($ludi[0]);
                        $this->em->flush();
                    }

                    $user->setBourse($rest);
                    $this->em->persist($user);
                    $this->em->flush();
                } else {
                    throw new \Exception("Vous n'avez pas assez d'argent");
                }
            } else {
                throw new \Exception("Vous devez construire un Ludi pour recruter des gladiateurs");
            }
        }
    }
}