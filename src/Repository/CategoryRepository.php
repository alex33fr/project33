<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * @return Category[] Returns an array of Category objects
     */

    public function findByLeftAndRight($value1, $value2, $value3)
    {
        return $this->createQueryBuilder('c')
            ->distinct()
            ->andWhere('c.lft >= :val1')
            ->andWhere('c.rgt <= :val2')
            ->andWhere('c.lvl = :val3')
            ->orderBy('c.id', 'ASC')
            ->setParameter('val1', $value1)
            ->setParameter('val2', $value2)
            ->setParameter('val3', $value3)
            ->getQuery()
            ->getResult()
            ;
    }

     /**
      * @return Category[] Returns an array of Category objects
      */

    public function findByTitle($value)
    {
        return $this->createQueryBuilder('c')
            ->select('c.title')
            ->andWhere('c.lvl = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }


    /*
    public function findOneBySomeField($value): ?Category
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
