<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
        ]);
    }

    // public function userProfil()
    // /**
    //  * @Route("/userProfil", name="userProfil")
    //  */
    // {
    //     return $this->render('profil/userProfil.html.twig', [
    //     ]);
    // }

    /**
     * @Route("/sondages", name="sondages")
     */
    public function indexSondage()
    {
        return $this->render('sondages/index.html.twig', [
        ]);
    }
}
