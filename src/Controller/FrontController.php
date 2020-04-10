<?php

namespace App\Controller;

use App\Entity\Category;
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

    /**
     * @Route("/products/{title}", name="oknaShow")
     * @param CategoryRepository $categoryRepository
     * @param Category $category
     * @return Response
     */
    public function oknaShow(CategoryRepository $categoryRepository, Category $category): Response
    {

        $val1 = $category->getLft();
        $val2 = $category->getRgt();
        $val3 = $category->getLvl();

        $categories = $categoryRepository->findByLeftAndRight($val1,$val2,++$val3);
        $products = $category->getProducts();

        return $this->render('front/productsShow.html.twig', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
