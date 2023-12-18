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
        $this->transliterator = transliterator_create('Any-Latin; Latin-ASCII');
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
        $login = $this->normalizeName($lastname.'_'.$firstname);
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
            'email' => $email,
            'login' => $login,
            'nom' => $lastname,
            'password' => $password,
            'prenom' => $firstname,
        ];
    }

    protected function normalizeName(string $normalize): string
    {
        return str_replace(' ', '_', mb_strtolower(transliterator_transliterate($this->transliterator, $normalize, 0, -1)));
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
