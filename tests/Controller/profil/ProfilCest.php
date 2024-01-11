<?php

namespace App\Tests\Controller\profil;

use App\Factory\EtudiantFactory;
use App\Factory\EtudiantPosteFactory;
use App\Factory\PosteFactory;
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

    public function testProfilWithAlternance(ControllerTester $I)
    {
        $poste = PosteFactory::createOne([
            'label' => 'alternance',
        ]);
        $etud = EtudiantFactory::createOne([
            'nom' => 'daret',
            'prenom' => 'tom',
            'postes' => [$poste],
        ]);
        EtudiantPosteFactory::createOne(['etudiant' => $etud, 'poste' => $poste]);
        $realEtud = $etud->object();
        $I->amLoggedInAs($realEtud);
        $I->amOnPage('/profil');
        $I->seeResponseCodeIsSuccessful();
        $I->seeNumberOfElements('div.infoposte', 1);
    }
}
