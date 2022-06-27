<?php

namespace App\DataFixtures;

use App\Entity\Bonus;
use App\Entity\Categories;
use App\Entity\Contracts;
use App\Entity\HistoriqueRecompense;
use App\Entity\Mission;
use App\Entity\MissionsHistory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
     
        $categories = new Categories();
        $categories->setName($faker->word());
        $categories->setColor($faker->hexColor());
        $categories->addMission($mission);

        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setEmail($faker->safeEmail());
            $user->setRoles([$faker->randomElement(['ROLE_PARENT', 'ROLE_CHILD'])]);
            $user->setPassword('test');
            $user->setName($faker->name());
            $user->setBonusPoints($faker->randomDigit());
            // créer des missions history pour les users  
            for ($i = 0; $i < 5; $i++) {
                $missionhistory = new MissionsHistory();
                $missionhistory->setEvaluatedDate($faker->dateTime());
                $missionhistory->setCompletedDate($faker->dateTime());
            }
            for ($i=0; $i < 5 ; $i++) {
                $mission = new Mission();
                $mission->setName($faker->name());
                $mission->setReward($faker->randomDigit());
                $mission->setConverted($faker->boolean());
                $mission->setCreatedAt($faker->dateTimeThisYear());
                $mission->setDate($faker->dateTimeThisYear());
                $mission->setBonusReward($faker->randomDigit()); // ajout bonus Id
                $mission->setUser($user);
                $mission->setEvaluated($faker->numberBetween(null|1, 3));
                $mission->setCompleted($faker->numberBetween(0, 1));
                $daysOfWeek = json_encode($faker->randomElements(['1', '2', '3', '4', '5', '6', '7'], 2), true);
                $mission->setDaysOfWeek($daysOfWeek);
                $mission->addMissionsHistory($missionhistory);
                $mission->addBonu($bonus);
                $mission->addContract($contract);
                
    
            }
            //créer les contrats pour les users.
            for ($i = 0; $i < 5; $i++) {
                $contracts = new Contracts();
                $contracts->setContent($faker->content());
                $contracts->setCreatedAt($faker->DateTimeImmutable());
                $contracts->setModifiedAt($faker->DateTimeImmutable());
                $contracts->setStatus($faker->randomDigit());
                $contracts->addUser($user);
            }
            // créer des bonus pour les users
            for ($i = 0; $i < 5; $i++) {
                $bonus = new Bonus();
                $bonus->setName($faker->name());
                $bonus->setPrice($faker->randomDigit());
                $bonus->setUser($user)
            }
            // créer des historiques récompenses pour les users          
            for ($i = 0; $i < 5; $i++) {
                $historiqueRecomp = new HistoriqueRecompense();
                $historiqueRecomp->setLibleRecomp($faker->libleRecomp());
                $historiqueRecomp->setDateRecomp($faker->dateTimeThisYear());
                $historiqueRecomp->setCoutRecomp($faker->randomDigit());
            }
            $manager->persist($categories);
            $manager->flush();
        }

        
    }
}
