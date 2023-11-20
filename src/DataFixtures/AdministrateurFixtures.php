<?php

namespace App\DataFixtures;

use App\Factory\AdministrateurFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class AdministrateurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        AdministrateurFactory::createMany(10);
    }
}
