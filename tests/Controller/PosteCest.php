<?php

namespace App\Tests\Controller;

use App\Factory\EntrepriseFactory;
use App\Factory\PosteFactory;
use App\Factory\TagFactory;
use App\Tests\Support\ControllerTester;

use function PHPUnit\Framework\assertEquals;

class PosteCest
{
    public function testSearch(ControllerTester $I)
    {
        // création d'une entité
        $entreprise = EntrepriseFactory::createOne(['addresse' => 'Paris', 'nom' => 'sbire']);
        $tag = TagFactory::createOne(['description' => 'blalbla', 'nom' => 'DEV_WEB']);
        $date_deb = \DateTime::createFromFormat('Y-m-d', '2024-11-24');
        $date_fin = \DateTime::createFromFormat('Y-m-d', '2025-02-12');
        PosteFactory::createOne(['date_deb' => $date_deb,
            'description' => 'blabla',
            'entreprise' => $entreprise,
            'label' => 'alternance',
            'lieu' => 'Paris',
            'tag' => $tag,
            'date_fin' => $date_fin,
        ]);
        // remplissage formulaire et recherche
        $I->amOnPage('/poste?search=DEV_WEB');
        // $I->fillField("//input[@type='search']", 'DEV_WEB');
        // $I->click('search-button');
        // vérification résultat
        // $I->seeCurrentRouteIs('app_poste',['search'=>'DEV_WEB']);
        // $I->amOnPage('/poste');
        assertEquals(['alternance', 'DEV_WEB', 'Paris', 'sbire', "24/11/2024 - 12/02/2025", 'blabla'], $I->grabMultiple('.alternance>ul>li'));
        // $I->see('DEV_WEB');
        // $I->see('blabla');
    }

    // tests
    public function testPostePage(ControllerTester $I)
    {
        // création d'une entité
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
        // vérification de la page et d'une entitée
        $I->amOnRoad('/poste');
        $I->seeResponseCodeIsSuccessful();
        $I->seeInTitle("Offres d'emploi basées sur votre recherche");
        $I->see('alternance');
        $I->see('blabla');
    }
}
