<?php

namespace App\DataFixtures;

use App\Entity\EtudiantPoste;
use App\Factory\EtudiantPosteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EtudiantPosteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        EtudiantPosteFactory::createMany(10);
    }
}
