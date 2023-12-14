<?php

namespace App\Tests\Controller\Site;

use App\Factory\PosteFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function _before(ControllerTester $I)
    {
    }

    // tests
    public function tryToTest(ControllerTester $I)
    {
    }

    public function testPageIndex(ControllerTester $I)
    {
        $I->amOnPage('/site');
        $I->seeResponseCodeIsSuccessful();
    }

    public function testPageStage(ControllerTester $I)
    {
        PosteFactory::createMany(5);
        $I->amOnPage('/poste');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle("Offres d'emploi basées sur votre recherche");
        $I->seeNumberOfElements('ul.alternance, ul.stage', 2);
    }
}
