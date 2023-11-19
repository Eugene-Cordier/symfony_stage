<?php

namespace App\Factory;

use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Etudiant>
 *
 * @method        Etudiant|Proxy create(array|callable $attributes = [])
 * @method static Etudiant|Proxy createOne(array $attributes = [])
 * @method static Etudiant|Proxy find(object|array|mixed $criteria)
 * @method static Etudiant|Proxy findOrCreate(array $attributes)
 * @method static Etudiant|Proxy first(string $sortedField = 'id')
 * @method static Etudiant|Proxy last(string $sortedField = 'id')
 * @method static Etudiant|Proxy random(array $attributes = [])
 * @method static Etudiant|Proxy randomOrCreate(array $attributes = [])
 * @method static EtudiantRepository|RepositoryProxy repository()
 * @method static Etudiant[]|Proxy[] all()
 * @method static Etudiant[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Etudiant[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Etudiant[]|Proxy[] findBy(array $attributes)
 * @method static Etudiant[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Etudiant[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class EtudiantFactory extends ModelFactory
{
    private \Transliterator $transliterator;
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
        $this->transliterator = \Transliterator::create('Any-Lower; Latin-ASCII');
        $firstname = self::faker()->firstName();
        $lastname = self::faker()->lastName();
        $email = $this->normalizeName($firstname).'.'.$this->normalizeName($lastname).'@'.self::faker()->domainName();
        $login = $firstname.'_'.$firstname;
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
        return str_replace(' ', '_', $this->transliterator->transliterate(mb_strtolower($normalize)));
    }


    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Etudiant $etudiant): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Etudiant::class;
    }
}
