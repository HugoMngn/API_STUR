<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Diary;
use Doctrine\Common\Collections\ArrayCollection;

class DiaryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        $manager->flush();
    }
}