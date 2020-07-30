<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Product;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="products")
     */
    public function products(ProductRepository $repository, PaginatorInterface $paginatorInterface, Request $request)
    {
        $products = $paginatorInterface->paginate(
            $repository->findAllWithPagination(),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('product/products.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @Route("/product/{id}", name="product")
     */
    public function product(Product $product, CommentRepository $repository, PaginatorInterface $paginatorInterface, Request $request)
    {
        $comments = $repository->getCommentsByProduct($product);

        return $this->render('product/product.html.twig', [
            'product' => $product,
            'comments' => $comments,
            'filter' => false
        ]);
    }

    /**
     * @Route("/product/{id}/filter/{filter}", name="filter_ascAndDesc")
     */
    public function filterByAscAndDesc(Product $product, CommentRepository $repository, $filter = null, EntityManagerInterface $manager)
    {

        if (!$filter) {
            $comments = $repository->getCommentsByProduct($product);

            $this->addFlash("error", "Une erreur est survenu, merci de bien vouloir recommencer");

            return $this->render('product/product.html.twig', [
                'product' => $product,
                'comments' => $comments,
                'filter' => false
            ]);
        }

        $comments = $repository->getCommentsByAscAndDesc($product, $filter);

        return $this->render('product/product.html.twig', [
            'product' => $product,
            'comments' => $comments,
            'filter' => $filter
        ]);
    }

    /**
     * @Route("/product/{id}/rating/{filter}", name="filter_rating")
     */
    public function filterByStars(Product $product, CommentRepository $repository, $filter = null)
    {
        if (!$filter) {
            $comments = $repository->getCommentsByProduct($product);

            $this->addFlash("error", "Une erreur est survenu, merci de bien vouloir recommencer");

            return $this->render('product/product.html.twig', [
                'product' => $product,
                'comments' => $comments,
                'filter' => false
            ]);
        }

        $filter = (int) $filter;

        $comments = $repository->getCommentsByStars($product, $filter);

        return $this->render('product/product.html.twig', [
            'product' => $product,
            'comments' => $comments,
            'filter' => $filter
        ]);
    }

    /**
     * @Route("/add/comment/{id}", name="add_comment")
     */
    public function addComment(Product $product, CommentRepository $repository, Request $request, EntityManagerInterface $manager)
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->isCsrfTokenValid("SUP" . $product->getId(), $request->get('_token'))) {
                $comment->setDate(new \DateTime('now'));
                $comment->setProduct($product);
                $manager->persist($comment);
                $manager->flush();
                $comments = $repository->getCommentsByProduct($product);
                $this->addFlash("success", "l'ajout du commentaire a été effectuée");
                return $this->render('product/product.html.twig', [
                    'product' => $product,
                    'comments' => $comments,
                    'filter' => false
                ]);
            }
        }

        return $this->render('product/addComment.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }
}
