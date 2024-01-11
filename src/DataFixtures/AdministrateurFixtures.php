<?php

namespace App\DataFixtures;

use App\Factory\AdministrateurFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AdministrateurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        AdministrateurFactory::createOne(['login' => 'admin', 'nom' => 'doe', 'prenom' => 'jhon', 'password' => 'test', 'email' => 'admin@example.com', 'roles' => ['ROLE_ADMIN']]);
    }
}
