<?php

namespace App\Controller;

use App\Entity\Association;
use App\Form\AssociationType;
use App\Repository\AssociationRepository;
use App\Entity\Partner;
use App\Form\PartnerType;
use App\Repository\PartnerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/admin", name="admin")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard_index")
     */
    public function index()
    {
        return $this->render('dashboard/index.html.twig', [
        ]);
    }
}
