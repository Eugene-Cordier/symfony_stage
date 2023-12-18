<?php

namespace App\Factory;

use App\Entity\Administrateur;
use App\Repository\AdministrateurRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Administrateur>
 *
 * @method        Administrateur|Proxy                     create(array|callable $attributes = [])
 * @method static Administrateur|Proxy                     createOne(array $attributes = [])
 * @method static Administrateur|Proxy                     find(object|array|mixed $criteria)
 * @method static Administrateur|Proxy                     findOrCreate(array $attributes)
 * @method static Administrateur|Proxy                     first(string $sortedField = 'id')
 * @method static Administrateur|Proxy                     last(string $sortedField = 'id')
 * @method static Administrateur|Proxy                     random(array $attributes = [])
 * @method static Administrateur|Proxy                     randomOrCreate(array $attributes = [])
 * @method static AdministrateurRepository|RepositoryProxy repository()
 * @method static Administrateur[]|Proxy[]                 all()
 * @method static Administrateur[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Administrateur[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Administrateur[]|Proxy[]                 findBy(array $attributes)
 * @method static Administrateur[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Administrateur[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class AdministrateurFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->transliterator = transliterator_create('Any-Latin; Latin-ASCII');
        $this->passwordHasher = $passwordHasher;
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
        $login = $this->normalizeName($lastname.'_'.$firstname);
        $email = $this->normalizeName($firstname).'.'.$this->normalizeName($lastname).'@'.self::faker()->domainName();
        // mot de passe tel que 5 int + un mot + 5int
        $password = '';
        for ($i = 0; $i < 5; ++$i) {
            $password .= self::faker()->randomDigit();
        }
        $password .= self::faker()->randomElement(['A', 'Z', 'h', 'm', 'q', 'Y', 'W', 'S', 'u', 'B'], 5);
        for ($j = 0; $j < 5; ++$j) {
            $password .= self::faker()->randomDigit();
        }

        return [
            'login' => $login,
            'nom' => $lastname,
            'password' => $password,
            'prenom' => $firstname,
            'email' => $email,
        ];
    }

    protected function normalizeName(string $normalize): string
    {
        return str_replace(' ', '_', mb_strtolower(transliterator_transliterate($this->transliterator, $normalize, 0, -1)));
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            ->afterInstantiate(function (Administrateur $admin) {
                $admin->setPassword($this->passwordHasher->hashPassword($admin, $admin->getPassword()));
            })
        ;
    }

    protected static function getClass(): string
    {
        return Administrateur::class;
    }
}
