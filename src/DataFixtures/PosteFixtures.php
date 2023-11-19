<?php

namespace App\DataFixtures;

use App\Factory\EntrepriseFactory;
use App\Factory\PosteFactory;
use App\Factory\TagFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class PosteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        PosteFactory::createMany(30, function () {
            return [
                'category' => EntrepriseFactory::random(),
                'tag' => TagFactory::random(),
            ];
        });
    }
    public function getDependencies(): array
    {
        return [
            EntrepriseFixtures::class,
            TagFixtures::class,
        ];

    }
}
