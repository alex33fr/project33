<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    /**
     * @Route("/sitemap.xml", name="sitemap", defaults={"_format"="xml"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // On recupere uniquement le debut de URL
        $hostname = $request->getSchemeAndHttpHost();

        $urls = [];

        // Creer les URLs "Statiques"
        $urls[] = ['loc' => $this->generateUrl('home')];
        $urls[] = ['loc' => $this->generateUrl('contact_form_new')];


        // On recupere les URLs Dynamiques
        foreach ($this->getDoctrine()->getRepository(Category::class)->findAll() as $category){
            $images = [
                'loc' => '/images/category/' . $category->getImageName(),
                'title' => $category->getAltImage(),
            ];

            $urls[] = [
                'loc' => $this->generateUrl('category_show', [
                    'id' => $category->getId()
                ]),
                'image' => $images,
                'priority' => "1.00"
            ];
        }
        foreach ($this->getDoctrine()->getRepository(Product::class)->findAll() as $product){
            $images = [
                'loc' => '/images/products/' . $product->getImageName(),
                'title' => $product->getAltImage(),
            ];

            $urls[] = [
                'loc' => $this->generateUrl('product_show', [
                    'id' => $product->getId()
                ]),
                'image' => $images,
                'lastmod' => $product->getUpdatedAt()->format('Y-m-d'),
                'priority' => "0.80"
            ];
        }


        //Fabriquer la reponse
        $response = new Response(
            $this->renderView('sitemap/index.html.twig', [
                'controller_name' => 'SitemapController',
                'urls' => $urls,
                'hostname' => $hostname
            ]),
            200
        );



        $response->headers->set('Content-Type', 'text/xml');

        return  $response;
    }
}
