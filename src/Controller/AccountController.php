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
    #[Route('/', name: 'app_account_index')]
    public function index(): Response
    {
        // $user = $this->getUser();
        return $this->render('users/profil.html.twig', [
            // 'user' => $user,
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
            return $this->redirectToRoute('app_activites', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('activites/new.html.twig', [
            'activity' => $activity,
            'form' => $form,
        ]);
    }

    #[Route('/show/activites', name: 'account_show_activities')]
    public function showActivities(): Response
    {
        $user = $this->getUser();
        return $this->render('users/activites.html.twig', [
            'activities' => $user->getActivities(),
        ]);
    }
}
