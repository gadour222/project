<?php

namespace App\Controller;
use App\Repository\EventRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ManagerController extends AbstractController
{
    /**
     * @Route("/manager",name="manager")
     */
    public function index(EventRepository $eventRepo): Response
    {
        $Event = $eventRepo->findAll();

        $eventNom = [];
        $eventColor = [];
        $eventCount = []; 

        foreach ($Event as $Eventss) {
            $eventNom[] = $Eventss->getName();
            $eventColor[] = $Eventss->getColor();
        
            // Vérifier si getNameEn est un tableau avant d'utiliser count
            $subject = $Eventss->getSubject();
            $eventCount[] = is_array($subject) ? count($subject) : 0;
        }
        


        return $this->render('manager/index.html.twig',[
              'eventNom' =>json_encode($eventNom),
              'eventColor' =>json_encode($eventColor),
              'eventCount' =>json_encode($eventCount)

        ]);
    }
}