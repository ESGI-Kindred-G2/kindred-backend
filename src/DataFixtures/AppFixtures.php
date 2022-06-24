<?php

namespace App\DataFixtures;

use App\Entity\Mission;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setEmail($faker->safeEmail());
            $user->setRoles($faker->randomElement(['ROLE_PARENT', 'ROLE_CHILD']));
            $user->setPassword('test');
            $user->setName($faker->name());
            $user->setBonusPoints($faker->randomDigit());
            for ($i=0; $i < 5 ; $i++) {
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
                $daysOfWeek = json_encode($faker->randomElements(['1', '2', '3', '4', '5', '6', '7'], 2), true);
                $mission->setDaysOfWeek($daysOfWeek);
            }
            $manager->persist($mission);
            $manager->flush();
        }

        
    }
}
