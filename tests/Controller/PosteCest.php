<?php

namespace App\Tests\Controller;

use App\Factory\PosteFactory;
use App\Tests\Support\ControllerTester;

class PosteCest
{
    public function testSearch(ControllerTester $I)
    {
        PosteFactory::createOne(['date_deb' => '22/11/2024',
            'description' => 'blabla',
            'entreprise' => null,
            'label' => 'alternance',
            'lieu' => 'Paris',
            'tag' => null,
            'date_fin' => '22/01/2025',
        ]);
        $I->amOnPage('/site');
        $I->fillField("//input[@type='search']", 'alternance');
        $I->click('Rechercher');
        $I->seeCurrentUrlEquals('http://localhost:8000/poste?search=alternance');
        $I->see('alternance');
        $I->see('blabla');
    }

    // tests
    public function tryToTest(ControllerTester $I)
    {
    }
}
