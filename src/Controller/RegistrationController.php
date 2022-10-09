<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ManagerRegistry;

use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;

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


        // TODO Just stops the user being added multiple times.
        // added for testing purposes. Will remvoe later.
        dd("Dummy User Registered");

        return $this->render('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
        ]);
    }

    /**
     * Test method to dump registered users.
     */
    #[Route('/users', name: 'app_users')]
    public function show(ManagerRegistry $doctrine) : Response
    {
        $users = $doctrine->getRepository(User::class)->find(1);
        dump($users);
        return new JsonResponse($users, 200, ["Content-Type" => "application/json"]);
    }
}
