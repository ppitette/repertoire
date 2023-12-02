<?php

namespace App\Repository;

use App\Entity\RepSearch;
use App\Entity\Secli;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Secli>
 *
 * @method Secli|null find($id, $lockMode = null, $lockVersion = null)
 * @method Secli|null findOneBy(array $criteria, array $orderBy = null)
 * @method Secli[]    findAll()
 * @method Secli[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SecliRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Secli::class);
    }

    public function findByRef($ref): ?Secli
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.cote = :ref')
            ->setParameter('ref', $ref)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findFiche(RepSearch $search): array
    {
        if ($search->getCote() && $search->getTitre()) {
            dd($search);
        }

        $query = $this->createQueryBuilder('s');

        if ($search->getCote()) {
            $query = $query
                ->andWhere('s.cote like :cote')
                ->setParameter('cote', $search->getCote());
        }

        if ($search->getTitre()) {
            $query = $query
                ->andWhere('s.titre like :titre')
                ->setParameter('titre', $search->getTitre());
        }

        $query = $query->orderBy('s.titre', 'ASC');

        return $query->getQuery()->getResult();
    }

    public function countAll(): int
    {
        return $this->createQueryBuilder('s')
            ->select('count(s.id)')
            ->getQuery()->getSingleScalarResult()
        ;
    }

    public function countAllImp(): int
    {
        return $this->createQueryBuilder('s')
            ->select('count(s.id)')
            ->andWhere('s.importe = :imp')
            ->setParameter('imp', true)
            ->getQuery()->getSingleScalarResult()
        ;
    }
}
