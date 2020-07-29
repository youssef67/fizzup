<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="products")
     */
    public function products(ProductRepository $repository)
    {
        $products = $repository->findAll();
        return $this->render('product/products.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * @Route("/product/{id}", name="product")
     */
    public function product(Product $product)
    {
        return $this->render('product/product.html.twig', [
            'product' => $product
        ]);
    }
}
