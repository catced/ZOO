<?php

namespace App\Repository;

use App\Entity\EtatAnimal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EtatAnimal>
 *
 * @method EtatAnimal|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtatAnimal|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtatAnimal[]    findAll()
 * @method EtatAnimal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatAnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtatAnimal::class);
    }

    //    /**
    //     * @return EtatAnimal[] Returns an array of EtatAnimal objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?EtatAnimal
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
