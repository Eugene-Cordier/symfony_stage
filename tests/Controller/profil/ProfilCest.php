<?php

namespace App\Tests\Controller\profil;

use App\Factory\EtudiantFactory;
use App\Tests\Support\ControllerTester;

class ProfilCest
{
    public function testProfil(ControllerTester $I)
    {
        $etud = EtudiantFactory::createOne([
            'nom' => 'daret',
            'prenom' => 'tom',
        ]);
        $realEtud = $etud->object();
        $I->amLoggedInAs($realEtud);
        $I->amOnPage('/profil');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle('Profil de daret tom');
        $I->see('Profil de daret tom', 'h1');
    }
}
