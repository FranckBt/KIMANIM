<?php

namespace App\Controller;

use App\Entity\Activities;
use App\Form\ActivitiesType;
use App\Repository\ActivitiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/activities/gestion')]
class ActivitiesGestionController extends AbstractController
{
    #[Route('/', name: 'app_activities_gestion_index', methods: ['GET'])]
    public function index(ActivitiesRepository $activitiesRepository): Response
    {
        return $this->render('activities_gestion/index.html.twig', [
            'activities' => $activitiesRepository->findAll(),
        ]);
    }


    #[Route('/{id}', name: 'app_activities_gestion_show', methods: ['GET'])]
    public function show(Activities $activity): Response
    {
        return $this->render('activities_gestion/show.html.twig', [
            'activity' => $activity,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_activities_gestion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Activities $activity, ActivitiesRepository $activitiesRepository): Response
    {
        $form = $this->createForm(ActivitiesType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activitiesRepository->add($activity);
            return $this->redirectToRoute('app_activities_gestion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('activities_gestion/edit.html.twig', [
            'activity' => $activity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_activities_gestion_delete', methods: ['POST'])]
    public function delete(Request $request, Activities $activity, ActivitiesRepository $activitiesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activity->getId(), $request->request->get('_token'))) {
            $activitiesRepository->remove($activity);
        }

        return $this->redirectToRoute('app_activities_gestion_index', [], Response::HTTP_SEE_OTHER);
    }
}
