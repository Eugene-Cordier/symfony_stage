<?php

namespace App\Repository;

use App\Entity\EtudiantPoste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EtudiantPoste>
 *
 * @method EtudiantPoste|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtudiantPoste|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtudiantPoste[]    findAll()
 * @method EtudiantPoste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantPosteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtudiantPoste::class);
    }
}
