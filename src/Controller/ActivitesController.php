<?php

namespace App\Controller;

use App\Entity\Activities;
use App\Repository\ActivitiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActivitesController extends AbstractController
{

    #[Route('/activites', name: 'app_activites', methods: ['GET'])]
    public function index(ActivitiesRepository $activityRepository): Response
    {
        return $this->render('activites/index.html.twig', [
            'activities' => $activityRepository->findAll(),
        ]);
    }
}
