<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class FrontController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @return Response
     */
    public function index()
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

//    public function categoryList()
//    {
//
//        $categories = $this->getDoctrine()->getRepository(Category::class)->findAll();
//        return $this->render('base.html.twig', [
//            'categories' => $categories,
//        ]);
//    }

    /**
     * @Route("/products/{title}", name="productsShow", methods={"GET"})
     * @param CategoryRepository $categoryRepository
     * @param Category $category
     * @return Response
     */
    public function productsShow(CategoryRepository $categoryRepository, Category $category): Response
    {

        $val1 = $category->getLft();
        $val2 = $category->getRgt();
        $val3 = $category->getLvl();

        $categories = $categoryRepository->findByLeftAndRight($val1,$val2,++$val3);
        $products = $category->getProducts();
        $categoriesShow = $categoryRepository->findByLeftAndRight($val1,$val2, 1);

        return $this->render('front/productPage.html.twig', [
            'categoriesShow' => $categoriesShow,
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    /**
     * @Route("/products/show/{id}", name="productShow", methods={"GET"})
     * @param Product $product
     * @return Response
     */
    public function show(Product $product): Response
    {
        return $this->render('front/productShow.html.twig', [
            'product' => $product,
        ]);
    }
}
