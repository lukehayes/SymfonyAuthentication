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
    public function new(UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        return $this->render('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
        ]);
    }

    #[Route('/createusers', name: 'app_createusers')]
    public function create(UserPasswordHasherInterface $passwordHasher, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        // Create a new user here for now.
        $u1 = new User();
        $u1->setEmail("example@example.com");
        $u1password = "password";

        $u1hashedpwd = $passwordHasher->hashPassword(
            $u1,
            $u1password
        );

        $u1->setPassword($u1hashedpwd);

        $u2 = new User();
        $u2->setEmail("developer@developer.com");
        $u2password = "password";

        $u2hashedpwd = $passwordHasher->hashPassword(
            $u2,
            $u2password
        );

        $u2->setPassword($u2hashedpwd);

        $entityManager->persist($u1);
        $entityManager->persist($u2);

        $entityManager->flush();


        // TODO Just stops the user being added multiple times.
        // added for testing purposes. Will remvoe later.
        dd("Dummy User Registered");

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
