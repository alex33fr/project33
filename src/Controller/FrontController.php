<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class FrontController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }


    // LEVEL 1
    /**
     * @Route("/{title}", name="allProductsShow", methods={"GET"})
     * @param ProductRepository $productRepository
     * @param CategoryRepository $categoryRepository
     * @param Category $category
     * @return Response
     */
    public function productsShowLvl1(ProductRepository $productRepository, CategoryRepository $categoryRepository, Category $category)
    {

        $value1 = $category->getLft();
        $value2 = $category->getRgt();
        $value3 = $category->getLvl();



        return $this->render('front/productsShow.html.twig', [
            'products' => $productRepository->findBy(['category' => $category]),
            'categories' => $categoryRepository->findByLeftAndRight($value1, $value2, $value3 + 1)
        ]);


    }

    /**
     * @Route("/{slug}", name="product_test")
     */
    public function productTest($slug){
        // On récupère l'article correspondant au slug
        $product = $this->getDoctrine()->getRepository(Product::class)->findOneBy(['slug' => $slug]);
        if(!$product){
            // Si aucun article n'est trouvé, nous créons une exception
            throw $this->createNotFoundException('L\'article n\'existe pas');
        }
        // Si l'article existe nous envoyons les données à la vue
        return $this->render('front/showTest.html.twig', compact('product'));
    }


    //LEVEL 2
    /**
     * @Route("/product/{title}", name="categoriesShow", methods={"GET"})
     * @param ProductRepository $productRepository
     * @param CategoryRepository $categoryRepository
     * @param Category $category
     * @return Response
     */
    public function productsShowLvl2(ProductRepository $productRepository, CategoryRepository $categoryRepository, Category $category)
    {

        $value1 = $category->getLft();
        $value2 = $category->getRgt();
        $value3 = $category->getLvl();



        return $this->render('front/productsShow.html.twig', [
            'products' => $productRepository->findBy(['category' => $category]),
            'categories' => $categoryRepository->findByLeftAndRight($value1, $value2, $value3 -1)
        ]);


    }
}
