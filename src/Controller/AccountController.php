<?php

namespace App\Controller;

use App\Entity\Activities;
use App\Entity\Users;
use App\Form\ActivityFrontType;
use App\Form\UserType;
use App\Repository\ActivitiesRepository;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route ('/account')]
class AccountController extends AbstractController
{

    #[Route('/', name: 'account_index')]
    public function index(ActivitiesRepository $activitiesRepository): Response
    {
        //Récupère l'utilisateur
        $user = $this->getUser();

        $activityConfirm = $activitiesRepository->getavtivityStatus($user->getId());
        $activityProjet = $activitiesRepository->getavtivityStatus($user->getId(), 'Projet');
        // dd($activityProjet);

        return $this->render('users/profil.html.twig', [
            'confirms' => $activityConfirm,
            'projects' => $activityProjet
        ]);
    }

    #[Route('/update', name: 'account_update', methods: ['GET', 'POST'])]
    public function edit(Request $request, UsersRepository $userRepository): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user);
            return $this->redirectToRoute('account_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('users/update.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/new/activity', name: 'account_create_activity', methods: ['GET', 'POST'])]
    public function new(Request $request, ActivitiesRepository $activityRepository): Response
    {
        $activity = new Activities();
        $form = $this->createForm(ActivityFrontType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activity->setUser($this->getUser());
            $activityRepository->add($activity);
            return $this->redirectToRoute('activites', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('activites/new.html.twig', [
            'activity' => $activity,
            'form' => $form,
        ]);
    }

    #[Route('/show/activites', name: 'account_show_activities')]
    public function showActivities(ActivitiesRepository $activitiesRepository): Response
    {
    }
}
