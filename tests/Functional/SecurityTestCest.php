<?php

namespace App\Tests\Functional;

use App\Entity\Etudiant;
use App\Factory\EtudiantFactory;
use App\Tests\Support\ControllerTester;
use App\Tests\Support\FunctionalTester;

class SecurityTestCest
{
    public function Authentication(FunctionalTester $I)
    {
        EtudiantFactory::createSequence([[
            'email' => 'maurice.bertin@ollivier.fr',
            'login' => 'maur001',
            'nom' => 'bertin',
            'password' => 'truc',
            'prenom' => 'maurice',
        ]]);
        $I->amOnPage('/login');
        $I->submitForm('form[name=login]', [
            'email' => 'maurice.bertin@ollivier.fr',
            'password' => 'truc',
            '_remember_me' => true,
        ]);
        $I->seeCurrentRouteIs('app_site');
    }
}
