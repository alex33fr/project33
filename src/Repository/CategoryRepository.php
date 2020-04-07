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
     * @param $value1
     * @param $value2
     * @param $value3
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
     * @param $value1
     * @return Category[] Returns an array of Category objects
     */

    public function findByLvl($value1)
    {
        return $this->createQueryBuilder('c')
            ->distinct()
            ->andWhere('c.lvl = :val1')
            ->orderBy('c.id', 'ASC')
            ->setParameter('val1', $value1)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return Category[] Returns an array of Category objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

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
