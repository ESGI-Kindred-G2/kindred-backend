<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;



class RegistrationController extends AbstractController
{
    #[Route('/api/registration/{usertype}', name: 'registration')]
    public function index(Request $request,UserPasswordHasherInterface $passwordHasher,ManagerRegistry $doctrine,$usertype): Response
    {
        $user = new User();

        switch ($usertype){
            case 'parent' :
                $user->setRoles(['ROLE_PARENT']);
                break;
            case 'child' :
                $user->setRoles(['ROLE_CHILD']);
                break;
        }

        $requestData = json_decode($request->getContent(), true);
       
       
        $user->setEmail($requestData["email"]);
        $user->setName($requestData["name"]);

        $plaintextPassword = $requestData["password"];

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->json([
            'message' => 'Utilisateur Enregistré',
            'User' => $user,
        ]);

    }
}