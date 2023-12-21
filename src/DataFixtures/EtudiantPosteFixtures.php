<?php

namespace App\DataFixtures;

use App\Entity\EtudiantPoste;
use App\Factory\EtudiantPosteFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EtudiantPosteFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        EtudiantPosteFactory::createMany(10);
    }

    public function getDependencies(): array
    {
        return [
            EtudiantFixtures::class,
            PosteFixtures::class,
        ];
    }
}
