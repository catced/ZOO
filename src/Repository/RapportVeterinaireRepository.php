<?php

namespace App\Repository;

use App\Entity\RapportVeto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RapportVeto>
 *
 * @method RapportVeto|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportVeto|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportVeto[]    findAll()
 * @method RapportVeto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportVetoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RapportVeto::class);
    }

    //    /**
    //     * @return RapportVeto[] Returns an array of RapportVeto objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?RapportVeto
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
