<?php

namespace App\DataFixtures;

use App\Factory\EntrepriseFactory;
use App\Factory\RecruteurFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class RecruteurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        RecruteurFactory::createMany(30, function () {
            return [
                'entreprise' => EntrepriseFactory::random(),
            ];
        });
    }

    public function getDependencies(): array
    {
        return [
            EntrepriseFixtures::class,
        ];

    }
}
