<?php

namespace App\DataFixtures;

use App\Factory\EntrepriseFactory;
use App\Factory\PosteFactory;
use App\Factory\TagFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PosteFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        PosteFactory::createMany(30, function () {
            $file_content = file_get_contents(__DIR__.'/data/posts_descriptions.json');
            $data = json_decode($file_content, true);
            return [
                'entreprise' => EntrepriseFactory::random(),
                'tag' => TagFactory::random(),
                'description' => $data[random_int(0,count($data)-1)]['description'],
            ];
        });
    }

    public function getDependencies(): array
    {
        return [
            TagFixtures::class,
            EntrepriseFixtures::class,
        ];
    }
}
