<?php

namespace App\Repository;

use App\Entity\Chant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Chant>
 *
 * @method Chant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Chant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Chant[]    findAll()
 * @method Chant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Chant::class);
    }

    public function save(Chant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Chant $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByRef($ref): ?Chant
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.cote = :ref')
            ->setParameter('ref', $ref)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findAllOrderTitre(): array
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.titre', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findFicheSecli($secli): ?Chant
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.secli = :secli')
            ->setParameter('secli', $secli)
            ->getQuery()
            ->getSingleResult()
        ;
    }

    public function countAll(): int
    {
        return $this->createQueryBuilder('c')
            ->select('count(c.id)')
            ->getQuery()->getSingleScalarResult()
        ;
    }
}
