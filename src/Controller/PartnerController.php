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
}
