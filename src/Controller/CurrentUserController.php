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

class CurrentUserController extends AbstractController
{
    #[Route('/api/currentUser/', name: 'currentUser')]
    public function index(Request $request,UserPasswordHasherInterface $passwordHasher,ManagerRegistry $doctrine, TokenStorageInterface $tokenStorageInterface, JWTTokenManagerInterface $jwtManager): Response
    {

        $this->jwtManager = $jwtManager;
        $this->tokenStorageInterface = $tokenStorageInterface;
        $decodedJwtToken = $this->jwtManager->decode($this->tokenStorageInterface->getToken());

        $userConnected = $doctrine->getRepository(User::class)->findBy(['email' => $decodedJwtToken['email']]);
  
            
        

        return $this->json(
            $userConnected,
        );

    }


}