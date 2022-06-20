<?php

namespace App\Controller;

use ApiPlatform\Core\OpenApi\Model\Contact;
use App\Entity\Contracts;
use App\Entity\Mission;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;



class CurrentMissionController extends AbstractController
{
    #[Route('/api/getId/{userid}', name: 'CurrentMission')]
    public function index(Request $request,UserPasswordHasherInterface $passwordHasher,ManagerRegistry $doctrine, $userid): Response
    {

            $user = $doctrine->getRepository(User::class)->find($userid);
            $contract1 = $user->getContracts();
            $contract2 = $doctrine->getRepository(Contracts::class)->findBy(['id' => $contract1[0]->getId()]);
            $contracts3 = $contract2[0]->getUsers()->getValues();

            $userContract = [];
            foreach($contracts3 as $contract3){
                $userContract[] = [
                    'userid' => $contract3->getId(),
                    'role' => $contract3->getRoles()[0],
                ];
            }

        return $this->json([
            'message' => 'Find User',
            'userInfo' => $userContract,
        ]);

    }
}