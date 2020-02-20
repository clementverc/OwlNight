<?php

namespace App\Controller;

use App\Entity\Association;
use App\Form\AssociationType;
use App\Repository\AssociationRepository;
use App\Entity\Partner;
use App\Form\PartnerType;
use App\Repository\PartnerRepository;
use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Entity\News;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\ApiService;

/**
 * @Route("/admin", name="admin_")
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

    /**
     * @Route("/association/list", name="association_list", methods={"GET"})
     */
    public function listAssociation(AssociationRepository $associationRepository, ApiService $apiService): Response
    {
        try {
            $response = $apiService->makeGet('/event');
            $data = $response->getBody()->getContents();
            // QUAND LA REQUETE EST OK
            dump($data);exit;
        } catch (\Exception $e) {
            // QUAND IL Y A UNE ERREUR HTTP CODE 400 ou plus
            dump($e);exit;
        }

        return $this->render('association/list.html.twig', [
            'associations' => $associationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/association/new", name="association_new", methods={"GET","POST"})
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
     * @Route("/association/{id}/edit", name="association_edit", methods={"GET","POST"})
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
     * @Route("association/{id}/delete", name="association_delete")
     */
    public function deleteAssociation(Request $request,AssociationRepository $associationRepository, $id)
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

    /**
     * @Route("/event/list", name="event_list", methods={"GET"})
     */
    public function listEvent(EventRepository $eventRepository): Response
    {
        return $this->render('event/list.html.twig', [
            'events' => $eventRepository->findAll(),
        ]);
    }

    /**
     * @Route("/event/new", name="event_new", methods={"GET","POST"})
     */
    public function newEvent(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('event_list');
        }

        return $this->render('event/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/event/{id}/edit", name="event_edit", methods={"GET","POST"})
     */
    public function editEvent(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_list');
        }

        return $this->render('event/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/event/{id}/delete", name="event_delete")
     */
    public function deleteEvent(Request $request,EventRepository $eventRepository, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $eventRepository->find($id);

        if (!$event) {
            return $this->redirectToRoute('event_list');
        }

        $em->remove($event);
        $em->flush();

        return $this->redirectToRoute('event_list');
    }

    /**
     * @Route("/news/list", name="news_list", methods={"GET"})
     */
    public function listNews(NewsRepository $newsRepository): Response
    {
        return $this->render('news/list.html.twig', [
            'news' => $newsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/news/new", name="news_new", methods={"GET","POST"})
     */
    public function newNews(Request $request): Response
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($news);
            $entityManager->flush();

            return $this->redirectToRoute('news_list');
        }

        return $this->render('news/new.html.twig', [
            'news' => $news,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/news/{id}/edit", name="news_edit", methods={"GET","POST"})
     */
    public function editNews(Request $request, News $news): Response
    {
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('news_list');
        }

        return $this->render('news/edit.html.twig', [
            'news' => $news,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/news/{id}/delete", name="news_delete")
     */
    public function deleteNews(Request $request,NewsRepository $newsRepository, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $news = $newsRepository->find($id);

        if (!$news) {
            return $this->redirectToRoute('news_list');
        }

        $em->remove($news);
        $em->flush();

        return $this->redirectToRoute('news_list');
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
