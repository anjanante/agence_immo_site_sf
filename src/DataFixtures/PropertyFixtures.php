<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $dNow = new \DateTime();
        $faker = Factory::create();
        for ($i=1;$i<=100;$i++)
        {
            $property = new Property();
            $property->setTitle($faker->words(3,true))
                ->setPrice($faker->numberBetween(10000,200000))
                ->setRooms($faker->numberBetween(2,10))
                ->setBedrooms($faker->numberBetween(1,9))
                ->setDescription($faker->sentences(3,true))
                ->setSurface($faker->numberBetween(20,350))
                ->setFloor($faker->numberBetween(0,15))
                ->setHeat($faker->numberBetween(0,count(Property::HEAT) - 1))
                ->setCity($faker->city)
                ->setAddress($faker->address)
                ->setPostalCode($faker->postcode)
                ->setStart($dNow)
                ->setSold(false);

            $manager->persist($property);
        }

        $manager->flush();
    }
}
