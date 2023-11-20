<?php

namespace App\Factory;

use App\Entity\Poste;
use App\Repository\PosteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Poste>
 *
 * @method        Poste|Proxy create(array|callable $attributes = [])
 * @method static Poste|Proxy createOne(array $attributes = [])
 * @method static Poste|Proxy find(object|array|mixed $criteria)
 * @method static Poste|Proxy findOrCreate(array $attributes)
 * @method static Poste|Proxy first(string $sortedField = 'id')
 * @method static Poste|Proxy last(string $sortedField = 'id')
 * @method static Poste|Proxy random(array $attributes = [])
 * @method static Poste|Proxy randomOrCreate(array $attributes = [])
 * @method static PosteRepository|RepositoryProxy repository()
 * @method static Poste[]|Proxy[] all()
 * @method static Poste[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Poste[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Poste[]|Proxy[] findBy(array $attributes)
 * @method static Poste[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Poste[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class PosteFactory extends ModelFactory
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
        $label = "stage";
        if(random_int(0,1) == 1)
        {
            $label = "alternance";
        }

        return [
            'date_deb' => self::faker()->dateTime(),
            'description' => self::faker()->text(255),
            'entreprise' => null,
            'label' => $label,
            'lieu' => self::faker()->city(),
            'tag' => null,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Poste $poste): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Poste::class;
    }
}
