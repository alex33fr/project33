<?php

namespace App\Controller;

use App\Entity\SubSubCategory;
use App\Form\SubSubCategoryType;
use App\Repository\SubSubCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sub/sub/category")
 */
class SubSubCategoryController extends AbstractController
{
    /**
     * @Route("/", name="sub_sub_category_index", methods={"GET"})
     */
    public function index(SubSubCategoryRepository $subSubCategoryRepository): Response
    {
        return $this->render('sub_sub_category/index.html.twig', [
            'sub_sub_categories' => $subSubCategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sub_sub_category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $subSubCategory = new SubSubCategory();
        $form = $this->createForm(SubSubCategoryType::class, $subSubCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subSubCategory);
            $entityManager->flush();

            return $this->redirectToRoute('sub_sub_category_index');
        }

        return $this->render('sub_sub_category/new.html.twig', [
            'sub_sub_category' => $subSubCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sub_sub_category_show", methods={"GET"})
     */
    public function show(SubSubCategory $subSubCategory): Response
    {
        return $this->render('sub_sub_category/show.html.twig', [
            'sub_sub_category' => $subSubCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sub_sub_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SubSubCategory $subSubCategory): Response
    {
        $form = $this->createForm(SubSubCategoryType::class, $subSubCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sub_sub_category_index');
        }

        return $this->render('sub_sub_category/edit.html.twig', [
            'sub_sub_category' => $subSubCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sub_sub_category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SubSubCategory $subSubCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subSubCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subSubCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sub_sub_category_index');
    }
}
