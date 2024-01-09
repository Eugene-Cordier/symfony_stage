<?php

namespace App\Repository;

use App\Entity\Poste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Poste>
 *
 * @method Poste|null find($id, $lockMode = null, $lockVersion = null)
 * @method Poste|null findOneBy(array $criteria, array $orderBy = null)
 * @method Poste[]    findAll()
 * @method Poste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PosteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Poste::class);
    }

    /* @return Poste[] */
    public function search(string $search = ''): array
    {
        $qb = $this->createQueryBuilder('p');
        $qb->addSelect('t')
            ->addSelect('e')
            ->where('LOWER(t.nom) LIKE LOWER(:search)')
            ->orWhere('LOWER(e.nom) LIKE LOWER(:search)')
            ->orWhere('LOWER(p.lieu) LIKE LOWER(:search)')
            ->orWhere('LOWER(p.label) LIKE LOWER(:search)')
            ->leftJoin('p.tag', 't')
            ->leftJoin('p.entreprise', 'e')
            ->setParameter('search', '%'.$search.'%')
        ;
        $query = $qb->getQuery();

        return $query->execute();
    }

    public function findWithTagAndEntreprise(int $id): ?Poste
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.tag', 't')
            ->leftJoin('p.entreprise', 'e')
            ->addSelect('t')
            ->addSelect('e')
            ->where('p.id = :id')
            ->setParameter(':id', $id);
        $query = $qb->getQuery();

        return $query->getOneOrNullResult();
    }
}
