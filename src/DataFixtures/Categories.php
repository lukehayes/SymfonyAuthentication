<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;

class Categories extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [
            "Work",
            "Important",
            "Reading",
            "Fun",
            "Done"
        ];

        array_map(function($elem) use ($manager)
        {
            $category = new Category();
            $category->setCategory($elem);
            $manager->persist($category);

        }, $categories);

        $manager->flush();
    }
}
