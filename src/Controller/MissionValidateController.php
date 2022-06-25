<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Entity\MissionsHistory;
use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;



class MissionValidateController extends AbstractController
{
    #[Route('/api/validateMission/{idMission}', name: 'validateMission')]
    public function index(Request $request,UserPasswordHasherInterface $passwordHasher,ManagerRegistry $doctrine,$idMission): Response
    {

        $mission = $doctrine->getRepository(Mission::class)->find($idMission);

        $requestData = json_decode($request->getContent(), true);

        $completed = isset($requestData["completed"]) ? $requestData["completed"] : $mission->getCompleted();
        $evaluated = isset($requestData["evaluated"]) ? $requestData["evaluated"] : $mission->getEvaluated();

        $mission->setCompleted($completed);
        $mission->setEvaluated($evaluated);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($mission);
        $entityManager->flush();

        $missionHistory = new MissionsHistory();

        if (isset($requestData["completed"])){
            if ($requestData["completed"] == 1){
                $missionHistory->setMissionId($mission);
                $missionHistory->setEvaluatedDate(new \DateTime());
                $missionHistory->setCompletedDate(new \DateTime());

                $entityManager = $doctrine->getManager();
                $entityManager->persist($missionHistory);
                $entityManager->flush();
            }
        }
        

        return $this->json([
            'message' => 'Mission validée',
            $mission,
        ]);

    }
}