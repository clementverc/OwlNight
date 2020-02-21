<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ApiService;

/**
 * @Route("/event")
 */
class EventController extends AbstractController
{
    /**
     * @Route("/", name="event_index", methods={"GET"})
     */
    public function index(EventRepository $eventRepository, ApiService $apiService): Response
    {
        $mock = [];
        try {
            $response = $apiService->makeGet('/event');
            $data = $response->getBody()->getContents();
            // QUAND LA REQUETE EST OK
            $data = json_decode($data, true);
        } catch (\Exception $e) {
            // QUAND IL Y A UNE ERREUR HTTP CODE 400 ou plus
            dump($e);exit;
        }

        return $this->render('event/index.html.twig', [
            'events' => $data,
        ]);
    }
}
