<?php

namespace App\DataFixtures;

use App\Entity\Option;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class OptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i=1;$i<=4;$i++)
        {
            $option = new Option();
            $option->setName($faker->streetSuffix());
            $manager->persist($option);
        }

        $manager->flush();
    }
}
