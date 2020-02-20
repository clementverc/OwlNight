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
}
