<?php

namespace App\Factory;

use App\Entity\Recruteur;
use App\Repository\RecruteurRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Recruteur>
 *
 * @method        Recruteur|Proxy create(array|callable $attributes = [])
 * @method static Recruteur|Proxy createOne(array $attributes = [])
 * @method static Recruteur|Proxy find(object|array|mixed $criteria)
 * @method static Recruteur|Proxy findOrCreate(array $attributes)
 * @method static Recruteur|Proxy first(string $sortedField = 'id')
 * @method static Recruteur|Proxy last(string $sortedField = 'id')
 * @method static Recruteur|Proxy random(array $attributes = [])
 * @method static Recruteur|Proxy randomOrCreate(array $attributes = [])
 * @method static RecruteurRepository|RepositoryProxy repository()
 * @method static Recruteur[]|Proxy[] all()
 * @method static Recruteur[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Recruteur[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Recruteur[]|Proxy[] findBy(array $attributes)
 * @method static Recruteur[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Recruteur[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class RecruteurFactory extends ModelFactory
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
        $firstname = self::faker()->firstName();
        $lastname = self::faker()->lastName();
        $login = $firstname.'_'.$firstname;
        return [
            'entreprise' => null,
            'login' => $login,
            'nom' => $lastname,
            'password' => '1234',
            'prenom' => $firstname,
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Recruteur $recruteur): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Recruteur::class;
    }
}
