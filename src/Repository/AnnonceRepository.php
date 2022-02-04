<?php

namespace App\Repository;

use App\Entity\Annonce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Annonce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Annonce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Annonce[]    findAll()
 * @method Annonce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnonceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Annonce::class);
    }

    /**
    * @return Annonce[] Returns an array of Annonce objects
    */

    public function findBySearchTerms($searchTerms): array
    {   /* avec les tags
        return $this->createQueryBuilder('a')
            ->leftJoin('a.tags', 'tag')
            ->innerJoin('a.user', 'user')
            ->addSelect('user')
            ->addSelect('tag')
            ->andWhere('
            user.firstname LIKE :searchTerms
            OR user.lastname LIKE :searchTerms
            OR user.email LIKE :searchTerms
            OR a.titre LIKE :searchTerms
            OR a.description LIKE :searchTerms
            OR tag.libelle LIKE :searchTerms
            ')
            ->setParameter(':searchTerms','%' . $searchTerms . '%')
            ->orderBy('a.date_de_publication', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;*/
        //sans les tags
        return $this->createQueryBuilder('a')
            ->innerJoin('a.user', 'user')
            ->addSelect('user')
            ->andWhere('
            user.firstname LIKE :searchTerms
            OR user.lastname LIKE :searchTerms
            OR user.email LIKE :searchTerms
            OR a.titre LIKE :searchTerms
            OR a.description LIKE :searchTerms
            ')
            ->setParameter(':searchTerms','%' . $searchTerms . '%')
            ->orderBy('a.date_de_publication', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }



    /*
    public function findOneBySomeField($value): ?Annonce
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
