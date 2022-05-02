<?php

namespace App\Controller;

use App\Entity\Activities;
use App\Form\ActivityFrontType;
use App\Repository\ActivitiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route ('/activites')]
class ActivitesController extends AbstractController
{

    #[Route('/', name: 'app_activites', methods: ['GET'])]
    public function index(ActivitiesRepository $activityRepository): Response
    {
        return $this->render('activites/index.html.twig', [
            'activities' => $activityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_activities_create', methods: ['GET', 'POST'])]
    public function new(Request $request, ActivitiesRepository $activityRepository): Response
    {
        $activity = new Activities();
        $form = $this->createForm(ActivityFrontType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activityRepository->add($activity);
            return $this->redirectToRoute('app_activities', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('activites/new.html.twig', [
            'activity' => $activity,
            'form' => $form,
        ]);
    }
}
