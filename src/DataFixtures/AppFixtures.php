<?php

namespace App\DataFixtures;

use App\Entity\Mission;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $mission = new Mission();
            $mission->setName($faker->name());
            $mission->setReward($faker->randomDigit());
            $mission->setConverted($faker->boolean());
            $mission->setCreatedAt($faker->dateTimeThisYear());
            $mission->setDate($faker->dateTimeThisYear());
            $mission->setBonusReward($faker->randomDigit()); // ajout bonus Id
            $mission->setUser($this->user); // ajout un id de user
            $mission->setCategories($this->catogorie); // ajout id de categorie
            $mission->setEvaluated($faker->numberBetween(null|1, 3));
            $mission->setCompleted($faker->numberBetween(0, 1));
            $mission->setDaysOfWeek($faker->randomElements(['1', '2', '3', '4', '5', '6', '7'], 2));
            $manager->persist($mission);
        }

        $manager->flush();
    }
}
