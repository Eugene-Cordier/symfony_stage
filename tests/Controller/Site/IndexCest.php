<?php

namespace App\Tests\Controller\Site;

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
}
