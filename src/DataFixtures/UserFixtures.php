<?php

namespace App\DataFixtures;

use App\Entity\Etude;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $etude1 = new Etude();
        $etude1->setName('droit');

        $etude2 = new Etude();
        $etude2->setName('droit');

        $user1 = new User();
        $user1
            ->setEmail("John@test.fr")
            ->setPseudonyme("John")
            ->setAge(23)
            ->setGender("Helicoptere")
            ->setPassword('password') // Change 'password' to the desired password
            ->setRoles(['ROLE_USER'])
            ->addEtude($etude1);

        $user2 = new User();
        $user2
            ->setEmail("Michel@test.fr")
            ->setPseudonyme("Michhel")
            ->setAge(23)
            ->setGender("Homme")
            ->setPassword('password') // Change 'password' to the desired password
            ->setRoles(['ROLE_USER'])
            ->addEtude($etude2);

        $manager->persist($user1);
        $manager->persist($user2);

        $manager->flush();
    }
}
