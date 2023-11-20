<?php

namespace App\Factory;

use App\Entity\Administrateur;
use App\Repository\AdministrateurRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Administrateur>
 *
 * @method        Administrateur|Proxy create(array|callable $attributes = [])
 * @method static Administrateur|Proxy createOne(array $attributes = [])
 * @method static Administrateur|Proxy find(object|array|mixed $criteria)
 * @method static Administrateur|Proxy findOrCreate(array $attributes)
 * @method static Administrateur|Proxy first(string $sortedField = 'id')
 * @method static Administrateur|Proxy last(string $sortedField = 'id')
 * @method static Administrateur|Proxy random(array $attributes = [])
 * @method static Administrateur|Proxy randomOrCreate(array $attributes = [])
 * @method static AdministrateurRepository|RepositoryProxy repository()
 * @method static Administrateur[]|Proxy[] all()
 * @method static Administrateur[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Administrateur[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Administrateur[]|Proxy[] findBy(array $attributes)
 * @method static Administrateur[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Administrateur[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class AdministrateurFactory extends ModelFactory
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
        $login = $lastname.'_'.$firstname;
        return [
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
            // ->afterInstantiate(function(Administrateur $administrateur): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Administrateur::class;
    }
}
