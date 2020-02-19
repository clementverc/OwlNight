<?php

namespace App\Controller;

use App\Entity\Association;
use App\Repository\AssociationRepository;
use App\Form\AssociationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/association")
 */
class AssociationController extends AbstractController
{
    /**
     * @Route("/", name="association_index", methods={"GET"})
     */
    public function index(AssociationRepository $associationRepository): Response
    {
        return $this->render('association/index.html.twig', [
            'associations' => $associationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/list", name="association_list", methods={"GET"})
     */
    public function list(AssociationRepository $associationRepository): Response
    {
        return $this->render('association/list.html.twig', [
            'associations' => $associationRepository->findAll(),
        ]);
    }
    
    /**
     * @Route("/new", name="association_new", methods={"GET","POST"})
     */
    public function newAssociation(Request $request): Response
    {
        $association = new Association();
        $form = $this->createForm(AssociationType::class, $association);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($association);
            $entityManager->flush();

            return $this->redirectToRoute('association_list');
        }

        return $this->render('association/new.html.twig', [
            'association' => $association,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="association_edit", methods={"GET","POST"})
     */
    public function editAssociation(Request $request, Association $association): Response
    {
        $form = $this->createForm(AssociationType::class, $association);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('association_list');
        }

        return $this->render('association/edit.html.twig', [
            'association' => $association,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("{id}/delete", name="association_delete")
     */
    public function delete(Request $request,AssociationRepository $associationRepository, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $association = $associationRepository->find($id);

        if (!$association) {
            return $this->redirectToRoute('association_list');
        }

        $em->remove($association);
        $em->flush();

        return $this->redirectToRoute('association_list');
    }
}
