<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\User;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_registration')]
    public function index(UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        // Create a new user here for now.
        $user = new User();
        $user->setEmail("example@example.com");
        $plainTextPassword = "password";


        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plainTextPassword
        );


        $user->setPassword($hashedPassword);

        $entityManager->persist($user);

        $entityManager->flush();


        return $this->render('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
        ]);
    }
}
