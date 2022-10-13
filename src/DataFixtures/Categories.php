<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class Categories extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $workCategory = new Category();
        $workCategory->setCategory("Work");

        $importantCategory = new Category();
        $importantCategory->setCategory("Important");


        $manager->persist($workCategory);
        $manager->persist($importantCategory);

        $manager->flush();
    }
}
