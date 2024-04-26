<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1
            ->setPseudonyme("John")
            ->setEmailAdress("John@test.fr")
            ->setAge(23)
            ->setGender("Helicoptere")
            ->setStudies("Droit"); 

        $user2 = new User();
        $user2
            ->setPseudonyme("Michhel")
            ->setEmailAdress("Michel@test.fr")
            ->setAge(23)
            ->setGender("Homme")
            ->setStudies("Comptabilité"); 


        $manager->persist($user1);
        $manager->persist($user2);

        $manager->flush();
    }
}