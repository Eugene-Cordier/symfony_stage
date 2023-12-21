<?php

namespace App\Factory;

use App\Entity\EtudiantPoste;
use App\Repository\EtudiantPosteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<EtudiantPoste>
 *
 * @method        EtudiantPoste|Proxy                     create(array|callable $attributes = [])
 * @method static EtudiantPoste|Proxy                     createOne(array $attributes = [])
 * @method static EtudiantPoste|Proxy                     find(object|array|mixed $criteria)
 * @method static EtudiantPoste|Proxy                     findOrCreate(array $attributes)
 * @method static EtudiantPoste|Proxy                     first(string $sortedField = 'id')
 * @method static EtudiantPoste|Proxy                     last(string $sortedField = 'id')
 * @method static EtudiantPoste|Proxy                     random(array $attributes = [])
 * @method static EtudiantPoste|Proxy                     randomOrCreate(array $attributes = [])
 * @method static EtudiantPosteRepository|RepositoryProxy repository()
 * @method static EtudiantPoste[]|Proxy[]                 all()
 * @method static EtudiantPoste[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static EtudiantPoste[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static EtudiantPoste[]|Proxy[]                 findBy(array $attributes)
 * @method static EtudiantPoste[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static EtudiantPoste[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class EtudiantPosteFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'cv' => file_get_contents(__DIR__.'/../../public/images/model-cv.jpg'),
            'etudiant' => EtudiantFactory::new(),
            'poste' => PosteFactory::new(),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(EtudiantPosteFixtures $etudiantPoste): void {})
        ;
    }

    protected static function getClass(): string
    {
        return EtudiantPoste::class;
    }
}
