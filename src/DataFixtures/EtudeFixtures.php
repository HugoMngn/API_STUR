<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use Doctrine\Common\Collections\ArrayCollection;

class EtudeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
    }
}