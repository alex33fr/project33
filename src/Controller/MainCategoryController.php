<?php

namespace App\Controller;

use App\Entity\MainCategory;
use App\Form\MainCategoryType;
use App\Repository\MainCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/main/category")
 */
class MainCategoryController extends AbstractController
{
    /**
     * @Route("/", name="main_category_index", methods={"GET"})
     */
    public function index(MainCategoryRepository $mainCategoryRepository): Response
    {
        return $this->render('main_category/index.html.twig', [
            'main_categories' => $mainCategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="main_category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $mainCategory = new MainCategory();
        $form = $this->createForm(MainCategoryType::class, $mainCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($mainCategory);
            $entityManager->flush();

            return $this->redirectToRoute('main_category_index');
        }

        return $this->render('main_category/new.html.twig', [
            'main_category' => $mainCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_category_show", methods={"GET"})
     */
    public function show(MainCategory $mainCategory): Response
    {
        return $this->render('main_category/show.html.twig', [
            'main_category' => $mainCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="main_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MainCategory $mainCategory): Response
    {
        $form = $this->createForm(MainCategoryType::class, $mainCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('main_category_index');
        }

        return $this->render('main_category/edit.html.twig', [
            'main_category' => $mainCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="main_category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MainCategory $mainCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mainCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($mainCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('main_category_index');
    }
}
