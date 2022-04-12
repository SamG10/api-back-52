<?php

namespace App\Controller;

use App\Entity\Gladiateur;
use App\Repository\LudiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrainingController extends AbstractController
{
    /**
     * @Route("api/training/{id}/physique", name="app_training", methods={"POST"})
     */
    public function physique(Gladiateur $gladiateur, EntityManagerInterface $em): Response
    {
        if ($gladiateur->getLudi()->getSpecialite() === "char" && $gladiateur->getEquilibre() > 0 && $gladiateur->getStrategie() > 0) {
            $addValue = rand(2, 4);
            $gladiateurNewAdresse = $gladiateur->getAdresse() + 0.4 * $addValue >=10 ? 10 : $gladiateur->getAddress() + 0.4 * $addValue;
            $gladiateurNewStrength = $gladiateur->getStrength() + 0.3 * $addValue >=10 ? 10 : $gladiateur->getStrength() + 0.4 * $addValue;
            $gladiateurNewEquilibre = $gladiateur->getEquilibre() - 0.1 * $addValue >=10 ? 10 : $gladiateur->getEquilibre() + 0.4 * $addValue;
            $gladiateurNewVitesse = $gladiateur->getVitesse() + 0.5 * $addValue >=10 ? 10 : $gladiateur->getVitesse() + 0.4 * $addValue;
            $gladiateurNewStrategie = $gladiateur->getStrategie() - 0.2 * $addValue >=10 ? 10 : $gladiateur->getStrategie() + 0.4 * $addValue;

            $gladiateur->setAdresse(round($gladiateurNewAdresse, 2))
                ->setStrength(round($gladiateurNewStrength, 2))
                ->setEquilibre(round($gladiateurNewEquilibre, 2))
                ->setVitesse(round($gladiateurNewVitesse, 2))
                ->setStrategie(round($gladiateurNewStrategie, 2));

            $em->persist($gladiateur);
            $em->flush();
        }


        if($gladiateur->getLudi()->getSpecialite() === "lutte" && $gladiateur->getEquilibre() > 0 && $gladiateur->getStrategie() > 0){
            $addValue = rand(3, 6);
            $gladiateurNewAdresse = $gladiateur->getAdresse() + 0.4 * $addValue;
            $gladiateurNewStrength = $gladiateur->getStrength() + 0.3 * $addValue;
            $gladiateurNewEquilibre = $gladiateur->getEquilibre() - 0.1 * $addValue;
            $gladiateurNewVitesse = $gladiateur->getVitesse() + 0.5 * $addValue;
            $gladiateurNewStrategie = $gladiateur->getStrategie() - 0.2 * $addValue;

            $gladiateur->setAdresse(round($gladiateurNewAdresse, 2))
                ->setStrength(round($gladiateurNewStrength, 2))
                ->setEquilibre(round($gladiateurNewEquilibre, 2))
                ->setVitesse(round($gladiateurNewVitesse, 2))
                ->setStrategie(round($gladiateurNewStrategie, 2));

            $em->persist($gladiateur);
            $em->flush();
        }

        if($gladiateur->getLudi()->getSpecialite() === "athletisme" && $gladiateur->getEquilibre() > 0 && $gladiateur->getStrategie() > 0){
            $addValue = rand(3, 5);
            $gladiateurNewAdresse = $gladiateur->getAdresse() + 0.4 * $addValue;
            $gladiateurNewStrength = $gladiateur->getStrength() + 0.3 * $addValue;
            $gladiateurNewEquilibre = $gladiateur->getEquilibre() - 0.1 * $addValue;
            $gladiateurNewVitesse = $gladiateur->getVitesse() + 0.5 * $addValue;
            $gladiateurNewStrategie = $gladiateur->getStrategie() - 0.2 * $addValue;

            $gladiateur->setAdresse(round($gladiateurNewAdresse, 2))
                ->setStrength(round($gladiateurNewStrength, 2))
                ->setEquilibre(round($gladiateurNewEquilibre, 2))
                ->setVitesse(round($gladiateurNewVitesse, 2))
                ->setStrategie(round($gladiateurNewStrategie, 2));

            $em->persist($gladiateur);
            $em->flush();
        }
        return $this->json($gladiateur, 201, [], ['groups' => "gladiateur_read"]);
    }

    /**
     * @Route("api/training/{id}/tactique", name="app_training_tactique", methods={"POST"})
     */
    public function tactique(Gladiateur $gladiateur, EntityManagerInterface $em): Response
    {
        if ($gladiateur->getLudi()->getSpecialite() === "char" && $gladiateur->getEquilibre() > 0 && $gladiateur->getStrategie() > 0) {
            $addValue = rand(3, 6);
            $gladiateurNewAdresse = $gladiateur->getAdresse() + 0.4 * $addValue;
            $gladiateurNewStrength = $gladiateur->getStrength() + 0.3 * $addValue;
            $gladiateurNewEquilibre = $gladiateur->getEquilibre() - 0.1 * $addValue;
            $gladiateurNewVitesse = $gladiateur->getVitesse() + 0.5 * $addValue;
            $gladiateurNewStrategie = $gladiateur->getStrategie() - 0.2 * $addValue;

            $gladiateur->setAdresse(round($gladiateurNewAdresse, 2))
                ->setStrength(round($gladiateurNewStrength, 2))
                ->setEquilibre(round($gladiateurNewEquilibre, 2))
                ->setVitesse(round($gladiateurNewVitesse, 2))
                ->setStrategie(round($gladiateurNewStrategie, 2));

            $em->persist($gladiateur);
            $em->flush();
        }


        if($gladiateur->getLudi()->getSpecialite() === "lutte" && $gladiateur->getEquilibre() > 0 && $gladiateur->getStrategie() > 0){
            $addValue = rand(1, 3);
            $gladiateurNewAdresse = $gladiateur->getAdresse() + 0.4 * $addValue;
            $gladiateurNewStrength = $gladiateur->getStrength() + 0.3 * $addValue;
            $gladiateurNewEquilibre = $gladiateur->getEquilibre() - 0.1 * $addValue;
            $gladiateurNewVitesse = $gladiateur->getVitesse() + 0.5 * $addValue;
            $gladiateurNewStrategie = $gladiateur->getStrategie() - 0.2 * $addValue;

            $gladiateur->setAdresse(round($gladiateurNewAdresse, 2))
                ->setStrength(round($gladiateurNewStrength, 2))
                ->setEquilibre(round($gladiateurNewEquilibre, 2))
                ->setVitesse(round($gladiateurNewVitesse, 2))
                ->setStrategie(round($gladiateurNewStrategie, 2));

            $em->persist($gladiateur);
            $em->flush();
        }

        if($gladiateur->getLudi()->getSpecialite() === "athletisme" && $gladiateur->getEquilibre() > 0 && $gladiateur->getStrategie() > 0){
            $addValue = rand(2, 3);
            $gladiateurNewAdresse = $gladiateur->getAdresse() + 0.4 * $addValue;
            $gladiateurNewStrength = $gladiateur->getStrength() + 0.3 * $addValue;
            $gladiateurNewEquilibre = $gladiateur->getEquilibre() - 0.1 * $addValue;
            $gladiateurNewVitesse = $gladiateur->getVitesse() + 0.5 * $addValue;
            $gladiateurNewStrategie = $gladiateur->getStrategie() - 0.2 * $addValue;

            $gladiateur->setAdresse(round($gladiateurNewAdresse, 2))
                ->setStrength(round($gladiateurNewStrength, 2))
                ->setEquilibre(round($gladiateurNewEquilibre, 2))
                ->setVitesse(round($gladiateurNewVitesse, 2))
                ->setStrategie(round($gladiateurNewStrategie, 2));

            $em->persist($gladiateur);
            $em->flush();
        }
        return $this->json($gladiateur, 201, [], ['groups' => "gladiateur_read"]);
    }

    /**
     * @Route("api/training/{id}/combine", name="app_training_combine", methods={"POST"})
     */
    public function combine(Gladiateur $gladiateur, EntityManagerInterface $em): Response
    {
        if ($gladiateur->getLudi()->getSpecialite() === "char" && $gladiateur->getEquilibre() > 0 && $gladiateur->getStrategie() > 0) {
            $addValue = rand(2, 7);
            $gladiateurNewAdresse = $gladiateur->getAdresse() + 0.4 * $addValue;
            $gladiateurNewStrength = $gladiateur->getStrength() + 0.3 * $addValue;
            $gladiateurNewEquilibre = $gladiateur->getEquilibre() - 0.1 * $addValue;
            $gladiateurNewVitesse = $gladiateur->getVitesse() + 0.5 * $addValue;
            $gladiateurNewStrategie = $gladiateur->getStrategie() - 0.2 * $addValue;

            $gladiateur->setAdresse(round($gladiateurNewAdresse, 2))
                ->setStrength(round($gladiateurNewStrength, 2))
                ->setEquilibre(round($gladiateurNewEquilibre, 2))
                ->setVitesse(round($gladiateurNewVitesse, 2))
                ->setStrategie(round($gladiateurNewStrategie, 2));

            $em->persist($gladiateur);
            $em->flush();
        }


        if($gladiateur->getLudi()->getSpecialite() === "lutte" && $gladiateur->getEquilibre() > 0 && $gladiateur->getStrategie() > 0){
            $addValue = rand(1, 5);
            $gladiateurNewAdresse = $gladiateur->getAdresse() + 0.4 * $addValue;
            $gladiateurNewStrength = $gladiateur->getStrength() + 0.3 * $addValue;
            $gladiateurNewEquilibre = $gladiateur->getEquilibre() - 0.1 * $addValue;
            $gladiateurNewVitesse = $gladiateur->getVitesse() + 0.5 * $addValue;
            $gladiateurNewStrategie = $gladiateur->getStrategie() - 0.2 * $addValue;

            $gladiateur->setAdresse(round($gladiateurNewAdresse, 2))
                ->setStrength(round($gladiateurNewStrength, 2))
                ->setEquilibre(round($gladiateurNewEquilibre, 2))
                ->setVitesse(round($gladiateurNewVitesse, 2))
                ->setStrategie(round($gladiateurNewStrategie, 2));

            $em->persist($gladiateur);
            $em->flush();
        }

        if($gladiateur->getLudi()->getSpecialite() === "athletisme" && $gladiateur->getEquilibre() > 0 && $gladiateur->getStrategie() > 0){
            $addValue = rand(3, 9);
            $gladiateurNewAdresse = $gladiateur->getAdresse() + 0.4 * $addValue;
            $gladiateurNewStrength = $gladiateur->getStrength() + 0.3 * $addValue;
            $gladiateurNewEquilibre = $gladiateur->getEquilibre() - 0.1 * $addValue;
            $gladiateurNewVitesse = $gladiateur->getVitesse() + 0.5 * $addValue;
            $gladiateurNewStrategie = $gladiateur->getStrategie() - 0.2 * $addValue;

            $gladiateur->setAdresse(round($gladiateurNewAdresse, 2))
                ->setStrength(round($gladiateurNewStrength, 2))
                ->setEquilibre(round($gladiateurNewEquilibre, 2))
                ->setVitesse(round($gladiateurNewVitesse, 2))
                ->setStrategie(round($gladiateurNewStrategie, 2));

            $em->persist($gladiateur);
            $em->flush();
        }
        return $this->json($gladiateur, 201, [], ['groups' => "gladiateur_read"]);
    }
}
