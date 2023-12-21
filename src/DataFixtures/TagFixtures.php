<?php

namespace App\DataFixtures;

use App\Factory\TagFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tags = json_decode(file_get_contents(__DIR__.'/data/tag.json'), true);
        $tag = [];
        for ($i = 0; $i < count($tags); $i = $i + 2) {
            $tag[] = [$tags[$i], $tags[$i + 1]];
        }
        foreach ($tag as $t) {
            TagFactory::createSequence(
                [
                    ['nom' => $t[0]['nom'], 'description' => $t[1]['description']],
                ]
            );
        }
    }
}
