<?php

namespace App\Repository;

use App\Entity\Subscriber;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Newsletter>
 */
class SubscriberRepository extends ServiceEntityRepository
{

    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry,EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Subscriber::class);
        $this->entityManager = $entityManager;
    }

    public function remove(Subscriber $subscriber, bool $flush = false): void
    {
        $this->getEntityManager()->remove($subscriber);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function save(Subscriber $subscriber): void
    {
        $this->entityManager->persist($subscriber);
        $this->entityManager->flush();
    }


    //    /**
    //     * @return Newsletter[] Returns an array of Newsletter objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('n.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Newsletter
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
