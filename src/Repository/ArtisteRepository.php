<?php

namespace App\Repository;

use App\Entity\Artiste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Artiste>
 *
 * @method Artiste|null find($id, $lockMode = null, $lockVersion = null)
 * @method Artiste|null findOneBy(array $criteria, array $orderBy = null)
 * @method Artiste[]    findAll()
 * @method Artiste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArtisteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Artiste::class);
    }

    public function save(Artiste $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Artiste $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function list(): array
    {
        return $this->createQueryBuilder('a')
            ->select('a.id')
            ->addSelect('a.lastname')
            ->addSelect('a.firstname')
            ->orderBy('a.lastname', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAllOrderName(): array
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.lastname', 'ASC')
            ->addOrderBy('a.firstname', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
