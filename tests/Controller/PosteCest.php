<?php

namespace App\Tests\Controller;

use App\Factory\PosteFactory;
use App\Tests\Support\ControllerTester;

class PosteCest
{
    public function testSearch(ControllerTester $I)
    {
        //création d'une entité
        $datedeb = PosteFactory::faker()->dateTimeBetween('+3 month', '+1 year');
        $datefin =
        PosteFactory::createOne(['date_deb' => \DateTime::createFromFormat('Y-m-d', '2024-11-24'),
            'description' => 'blabla',
            'entreprise' => null,
            'label' => 'alternance',
            'lieu' => 'Paris',
            'tag' => null,
            'date_fin' => \DateTime::createFromFormat('Y-m-d', '2025-02-12'),
        ]);
        // remplissage formulaire et recherche
        $I->amOnPage('/site');
        $I->fillField("//input[@type='search']", 'alternance');
        $I->click('Rechercher');
        //vérification résultat
        $I->seeCurrentUrlEquals('http://localhost:8000/poste?search=alternance');
        $I->see('alternance');
        $I->see('blabla');
    }

    // tests
    public function tryToTest(ControllerTester $I)
    {
    }
}
