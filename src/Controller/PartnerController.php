<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Form\PartnerType;
use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/partner")
 */
class PartnerController extends AbstractController
{
    /**
     * @Route("/", name="partner_index", methods={"GET"})
     */
    public function index(PartnerRepository $partnerRepository): Response
    {
        return $this->render('partner/index.html.twig', [
            'partners' => $partnerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/list", name="partner_list", methods={"GET"})
     */
    public function list(PartnerRepository $partnerRepository): Response
    {
        return $this->render('partner/list.html.twig', [
            'partners' => $partnerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="partner_new", methods={"GET","POST"})
     */
    public function newPartner(Request $request): Response
    {
        $partner = new Partner();
        $form = $this->createForm(PartnerType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($partner);
            $entityManager->flush();

            return $this->redirectToRoute('partner_list');
        }

        return $this->render('partner/new.html.twig', [
            'partner' => $partner,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("{id}/edit", name="partner_edit", methods={"GET","POST"})
     */
    public function editPartner(Request $request, Partner $partner): Response
    {
        $form = $this->createForm(PartnerType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('partner_list');
        }

        return $this->render('partner/edit.html.twig', [
            'partner' => $partner,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("{id}/delete", name="partner_delete")
     */
    public function delete(Request $request,PartnerRepository $partnerRepository, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $partner = $partnerRepository->find($id);

        if (!$partner) {
            return $this->redirectToRoute('partner_list');
        }

        $em->remove($partner);
        $em->flush();

        return $this->redirectToRoute('partner_list');
    }
}
