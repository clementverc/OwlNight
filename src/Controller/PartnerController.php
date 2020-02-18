<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PartnerController extends AbstractController
{
    /**
     * @Route("/partner", name="partner")
     */
    public function index()
    {
        return $this->render('partner/index.html.twig', [
            'controller_name' => 'PartnerController',
        ]);
    }
}
