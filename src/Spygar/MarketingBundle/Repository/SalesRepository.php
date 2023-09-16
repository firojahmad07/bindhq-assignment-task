<?php

namespace Spygar\MarketingBundle\Repository;

use Spygar\MarketingBundle\Entity\Sales;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sales>
 *
 * @method Sales|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sales|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sales[]    findAll()
 * @method Sales[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sales::class);
    }

    public function save(Sales $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Sales $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Sales[] Returns an array of all companies Sales 
    */
   public function getCompaniesWithSales(): array
   {
       return $this->createQueryBuilder('s')
            ->select('c.id, c.name as companyName, SUM(s.amount) as amount, count(s.id) as sales')
            ->leftJoin('s.company', 'c')
            ->groupBy('s.company')
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
       ;
   }

      /**
    * @return Sales[] Returns an array of Sales of single company
    */
    public function getCompanySales($companyId): array
    {
        return $this->createQueryBuilder('s')
             ->select('c.id, c.name as companyName, SUM(s.amount) as amount')
             ->leftJoin('s.company', 'c')
             ->groupBy('s.company')
             ->where('c.id =:companyId')
             ->setParameters(['companyId' => $companyId])
             ->orderBy('s.id', 'ASC')
             ->getQuery()
             ->getResult()
        ;
    }
//    public function findOneBySomeField($value): ?Sales
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
