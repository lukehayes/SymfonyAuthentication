<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Task;
use App\Entity\User;
use App\Repository\UserRepository;

class AppFixtures extends Fixture
{
    private $userRepository = NULL;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail("developer@developer.com");
        $user->setPassword("password");
        dump($user);

        $t1 = new Task();
        $t1->setTask("Foreign Key Task 1");
        $t1->setUserId($user);
        $t1->setCompleted(false);

        $t2 = new Task();
        $t2->setTask("Foreign Key Task 2");
        $t2->setUserId($user);
        $t2->setCompleted(false);

        $manager->persist($t1);
        $manager->persist($t2);
        $manager->persist($user);
        $manager->flush();
    }
}
