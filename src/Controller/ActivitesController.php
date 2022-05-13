<?php

namespace App\Controller;

use App\Repository\ActivitiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route ('/activites')]
class ActivitesController extends AbstractController
{

    #[Route('/', name: 'activites', methods: ['GET'])]
    public function index(ActivitiesRepository $activitiesRepository): Response
    {
        $activities = $activitiesRepository->findBy(
            ['status' => 'en ligne'],
            ['start_on' => 'DESC']
    );
        return $this->render('activites/index.html.twig', [
            'activities' => $activities,
        ]);
    }
}
