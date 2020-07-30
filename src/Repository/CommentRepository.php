<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\Product;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function getCommentsByProduct(Product $product)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.product = :val')
            ->setParameter('val', $product->getId())
            ->getQuery()
            ->getResult();
    }

    public function getCommentsByStars(Product $product, $filter = null)
    {
        $req = $this->createQueryBuilder('c')
            ->andWhere('c.product = :val')
            ->setParameter('val', $product->getId());
        if ($filter === 1) {
            $req = $req->andWhere('c.rating = :value')
                ->setParameter(':value', $filter);
        }
        if ($filter === 2) {

            $req = $req->andWhere('c.rating = :value')
                ->setParameter(':value', $filter);
        }
        if ($filter === 3) {

            $req = $req->andWhere('c.rating = :value')
                ->setParameter(':value', $filter);
        }
        if ($filter === 4) {

            $req = $req->andWhere('c.rating = :value')
                ->setParameter(':value', $filter);
        }
        if ($filter === 5) {

            $req = $req->andWhere('c.rating = :value')
                ->setParameter(':value', $filter);
        }
        $req = $req->getQuery();
        return $req->getResult();
    }

    public function getCommentsByAscAndDesc(Product $product, $filter = null)
    {
        $req = $this->createQueryBuilder('c')
            ->andWhere('c.product = :val')
            ->setParameter('val', $product->getId());
        if ($filter === 'latest') {
            $req = $req->orderBy('c.date', 'DESC');
        }
        if ($filter === 'oldest') {
            $req = $req->orderBy('c.date', 'ASC');
        }
        if ($filter === 'best') {
            $req = $req->orderBy('c.rating', 'DESC');
        }
        if ($filter === 'worst') {
            $req = $req->orderBy('c.rating', 'ASC');
        }
        $req = $req->getQuery();
        return $req->getResult();
    }
}
