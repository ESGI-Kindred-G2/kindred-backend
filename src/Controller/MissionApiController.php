<?php

namespace App\Controller;

use ApiPlatform\Core\OpenApi\Model\Contact;
use App\Entity\Contracts;
use App\Entity\Mission;
use App\Entity\MissionsHistory;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class MissionApiController extends AbstractController
{
    #[Route('/api/EventsData/', name: 'missionsApi')]
    public function index(Request $request,UserPasswordHasherInterface $passwordHasher,ManagerRegistry $doctrine, TokenStorageInterface $tokenStorageInterface, JWTTokenManagerInterface $jwtManager): Response
    {

            $this->jwtManager = $jwtManager;
            $this->tokenStorageInterface = $tokenStorageInterface;
            $decodedJwtToken = $this->jwtManager->decode($this->tokenStorageInterface->getToken());

           $userConnected = $doctrine->getRepository(User::class)->findBy(['email' => $decodedJwtToken['email']]);

           $userId = $userConnected[0]->getId();

           if($userConnected[0]->getRoles()[0] == 'ROLE_PARENT'){
            $contract1 = $userConnected[0]->getContracts();
            $contract2 = $doctrine->getRepository(Contracts::class)->findBy(['id' => $contract1[0]->getId()]);
            $contracts3 = $contract2[0]->getUsers()->getValues();
            
            foreach($contracts3 as $c){
                if($c->getRoles()[0] == 'ROLE_CHILD'){
                    $userId = $c->getId();
                }
            }
           }


           $mission = $doctrine->getRepository(Mission::class)->findBy(['user' => $userId]);

            $EventsData = [];
            foreach($mission as $EventData){
                $missionHistory = $doctrine->getRepository(MissionsHistory::class)->findBy(['missionId' => $EventData->getId()]);
                $EventsData[] = [
                    'completed' => $EventData->getCompleted(),
                    'date' => $EventData->getDate(),
                    'evaluated' => $EventData->getEvaluated(),
                    'id' => $EventData->getId(),
                    'reward' => $EventData->getReward(),
                    'bonusReward' => $EventData->getBonusReward(),
                    'daysOfWeek' => $EventData->getDaysOfWeek(),
                    'name' => $EventData->getName(),
                    "categories" => $EventData->getCategories(),
                    'history' => $missionHistory,
                ];
            }


        return $this->json([
            'message' => 'Find User',
            'events' => $EventsData,
        ]);

    }


}