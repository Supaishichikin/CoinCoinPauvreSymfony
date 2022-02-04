<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilController extends AbstractController
{
    /**
     * @Route("/vote/{user_id}/{direction}", name="user-vote")
     */
    public function index($user_id, $direction, UserRepository $repository, EntityManagerInterface $manager): Response
    {
        $user = $repository->findOneBy(['id' => $user_id]);

        if($direction == 'up'){
            $vote = $user->voteUp();
        }elseif ($direction == 'down'){
            $vote = $user->voteDown();
        }
        $manager->persist($user);
        $manager->flush();

        //todo créer une table vote et une table vote_userVoteReceiver_userVoteProvider avec 3 column (les id respectif
        // des 2 user et du vote avec une contrainte d'unicité)


        return new JsonResponse(['vote' => $vote->getVotes()]);
    }
}
