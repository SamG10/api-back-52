<?php

namespace App\Controller;

use App\Entity\Gladiateur;
use App\Repository\GladiateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class JeuDuCirqueController extends AbstractController
{
    /**
     * @Route("api/games", name="app_games", methods={"POST"})
     */
    public function Char(GladiateurRepository $gladiateurRepository, EntityManagerInterface $em)
    {
        $gladiateurs = $gladiateurRepository->findAll();
        $results = [];

        foreach ($gladiateurs as $g){
            $glad = [
                "id" => $g->getId(),
                "perf-char" => $g->getValeurChar(),
                "perf-lutte" => $g->getValeurLutte(),
                "perf-athletisme" => $g->getValeurAthletisme()
            ];
            $results[] = $glad;
        }

        $epreuve = 3;

        if($epreuve === 1){
            array_multisort(array_column($results, 'perf-char'), SORT_DESC, $results);
            $winner = $gladiateurRepository->find($results[0]["id"]);
            $gain = $winner->getEquilibre() + 1;
            $winner->setEquilibre($gain);

        }elseif ($epreuve === 2){
            array_multisort(array_column($results, 'perf-lutte'), SORT_DESC, $results);
            $winner = $gladiateurRepository->find($results[0]["id"]);
            $gain = $winner->getStrength() + 1 >= 10 ? 10 : $winner->getStrength() + 1;
            $winner->setStrength($gain);

        }elseif ($epreuve === 3){
            array_multisort(array_column($results, 'perf-athletisme'), SORT_DESC, $results);
            $winner = $gladiateurRepository->find($results[0]["id"]);
            $adresse = $winner->getAdresse() + 0.2 >= 10 ? 10 : $winner->getAdresse() + 0.2;
            $equilibre = $winner->getEquilibre() + 0.2 >= 10 ? 10 : $winner->getEquilibre() + 0.2;
            $strength = $winner->getStrength() + 0.2 >= 10 ? 10 : $winner->getStrength() + 0.2;
            $vitesse = $winner->getVitesse() + 0.2 >= 10 ? 10 : $winner->getVitesse() + 0.2;
            $strategie = $winner->getStrategie() + 0.2 >= 10 ? 10 : $winner->getStrategie() + 0.2;
            $winner->setStrength(round($strength, 2))
            ->setAdresse(round($adresse, 2))
            ->setEquilibre(round($equilibre, 2))
            ->setVitesse(round($vitesse, 2))
            ->setStrategie(round($strategie,2));
        }
        $user = $winner->getLudi()->getUser();
        $gagneCoin = $user->getBourse() + 2;
        $user->setBourse($gagneCoin);
        $em->persist($user);
        $em->persist($winner);
        $em->flush();
    return $this->json($gladiateurs, 201,[],['groups' => "gladiateur_read"]);
    }
}
