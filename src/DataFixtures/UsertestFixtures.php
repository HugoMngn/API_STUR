<?php

namespace App\DataFixtures;

use App\Entity\Etude;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Usertest;

class UsertestFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $etude1= new Etude;
        $etude1->setName('droit');

        $etude2= new Etude;
        $etude2->setName('droit');


        $user1 = new Usertest();
        $user1
            ->setPseudonyme("John")
            ->setEmailAdress("John@test.fr")
            ->setAge(23)
            ->setGender("Helicoptere")
            ->addEtude($etude1); 

        $user2 = new Usertest();
        $user2
            ->setPseudonyme("Michhel")
            ->setEmailAdress("Michel@test.fr")
            ->setAge(23)
            ->setGender("Homme")
            ->addEtude($etude2); 


        $manager->persist($user1);
        $manager->persist($user2);

        $manager->flush();
    }
}