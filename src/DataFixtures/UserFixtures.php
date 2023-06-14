<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;


class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail("dev@dev.com");
        $user->setPassword("password");

        $manager->persist($user);

        for($i = 0; $i <= 10; $i++)
        {
            $user = new User();
            $user->setEmail("user$i@app.com");
            $user->setPassword("user$i");
            $manager->persist($user);
        }

        $manager->flush();
    }
}
