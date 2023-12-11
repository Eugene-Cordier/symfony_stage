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
        if (!empty($search)) {
            $qb->addSelect('t')
                ->addSelect('e')
                ->where('t.nom LIKE :search')
                ->orWhere('e.nom LIKE :search')
                ->orWhere('p.lieu LIKE :search')
                ->orWhere('p.label LIKE :search')
                ->leftJoin('p.tag', 't')
                ->leftJoin('p.entreprise', 'e')
                ->setParameter('search', '%'.$search.'%')
            ;
        }
        $query = $qb->getQuery();

        return $query->execute();
    }

    //    /**
    //     * @return Poste[] Returns an array of Poste objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Poste
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
