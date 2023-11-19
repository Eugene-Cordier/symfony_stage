<?php

namespace App\DataFixtures;

use App\Factory\EtudiantFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        EtudiantFactory::createMany(10);
        $manager->flush();
    }
}
