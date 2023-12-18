<?php

namespace App\Factory;

use App\Entity\Recruteur;
use App\Repository\RecruteurRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Recruteur>
 *
 * @method        Recruteur|Proxy                     create(array|callable $attributes = [])
 * @method static Recruteur|Proxy                     createOne(array $attributes = [])
 * @method static Recruteur|Proxy                     find(object|array|mixed $criteria)
 * @method static Recruteur|Proxy                     findOrCreate(array $attributes)
 * @method static Recruteur|Proxy                     first(string $sortedField = 'id')
 * @method static Recruteur|Proxy                     last(string $sortedField = 'id')
 * @method static Recruteur|Proxy                     random(array $attributes = [])
 * @method static Recruteur|Proxy                     randomOrCreate(array $attributes = [])
 * @method static RecruteurRepository|RepositoryProxy repository()
 * @method static Recruteur[]|Proxy[]                 all()
 * @method static Recruteur[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Recruteur[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Recruteur[]|Proxy[]                 findBy(array $attributes)
 * @method static Recruteur[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Recruteur[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class RecruteurFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    private $passwordHasher;

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
            'entreprise' => null,
            'login' => $login,
            'nom' => $lastname,
            'password' => $password,
            'prenom' => $firstname,
            'telephone' => null,
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
            ->afterInstantiate(function (Recruteur $recruteur) {
                $recruteur->setPassword($this->passwordHasher->hashPassword($recruteur, $recruteur->getPassword()));
            })
        ;
    }

    protected static function getClass(): string
    {
        return Recruteur::class;
    }
}
