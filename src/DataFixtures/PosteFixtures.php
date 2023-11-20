<?php

namespace App\DataFixtures;

use App\Factory\EntrepriseFactory;
use App\Factory\PosteFactory;
use App\Factory\TagFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
;

class PosteFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        PosteFactory::createMany(30, function () {
            return [
                'entreprise' => EntrepriseFactory::random(),
                'tag' => TagFactory::random(),
            ];
        });
    }
    public function getDependencies(): array
    {
        return [
            TagFixtures::class,
        ];

    }
}
