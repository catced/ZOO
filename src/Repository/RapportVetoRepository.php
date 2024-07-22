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

    //mise en place de filtre sur les rapports vétérinaire par administrateur 
    public function findByCriteria(array $criteria)
    {
        $qb = $this->createQueryBuilder('r')
            ->leftJoin('r.animal', 'a')
            ->leftJoin('r.veterinaire', 'v')
            ->addSelect('a', 'v');

        if (isset($criteria['datepassage'])) {
            $qb->andWhere('r.datepassage = :datepassage')
                ->setParameter('datepassage', $criteria['datepassage']->format('Y-m-d'));
        }

        if (isset($criteria['animal.prenom'])) {
            $qb->andWhere('a.prenom LIKE :animal')
                ->setParameter('animal', '%' . $criteria['animal.prenom'] . '%');
        }

        if (isset($criteria['veterinaire.username'])) {
            $qb->andWhere('v.username LIKE :veterinaire')
                ->setParameter('veterinaire', '%' . $criteria['veterinaire.username'] . '%');
        }

        return $qb->getQuery()->getResult();
    }
        
    
}
