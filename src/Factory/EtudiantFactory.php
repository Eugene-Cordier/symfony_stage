<?php

namespace App\Factory;

use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Etudiant>
 *
 * @method        Etudiant|Proxy                     create(array|callable $attributes = [])
 * @method static Etudiant|Proxy                     createOne(array $attributes = [])
 * @method static Etudiant|Proxy                     find(object|array|mixed $criteria)
 * @method static Etudiant|Proxy                     findOrCreate(array $attributes)
 * @method static Etudiant|Proxy                     first(string $sortedField = 'id')
 * @method static Etudiant|Proxy                     last(string $sortedField = 'id')
 * @method static Etudiant|Proxy                     random(array $attributes = [])
 * @method static Etudiant|Proxy                     randomOrCreate(array $attributes = [])
 * @method static EtudiantRepository|RepositoryProxy repository()
 * @method static Etudiant[]|Proxy[]                 all()
 * @method static Etudiant[]|Proxy[]                 createMany(int $number, array|callable $attributes = [])
 * @method static Etudiant[]|Proxy[]                 createSequence(iterable|callable $sequence)
 * @method static Etudiant[]|Proxy[]                 findBy(array $attributes)
 * @method static Etudiant[]|Proxy[]                 randomRange(int $min, int $max, array $attributes = [])
 * @method static Etudiant[]|Proxy[]                 randomSet(int $number, array $attributes = [])
 */
final class EtudiantFactory extends ModelFactory
{
    private $passwordHasher;

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
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
        $email = $this->normalizeName($firstname).'.'.$this->normalizeName($lastname).'@'.self::faker()->domainName();
        $login = $lastname.'_'.$firstname;

        return [
            'email' => $email,
            'login' => $login,
            'nom' => $lastname,
            'password' => '1234',
            'prenom' => $firstname,
        ];
    }

    protected function normalizeName(string $normalize): string
    {
        return str_replace(' ', '_', mb_strtolower($normalize));
    }

    protected function initialize(): self
    {
        return $this
            ->afterInstantiate(function (Etudiant $etud) {
                $etud->setPassword($this->passwordHasher->hashPassword($etud, $etud->getPassword()));
            })
        ;
    }

    protected static function getClass(): string
    {
        return Etudiant::class;
    }
}
