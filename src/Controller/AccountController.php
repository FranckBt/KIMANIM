<?php

namespace App\Controller;

use App\Entity\Activities;
use App\Form\ActivitiesType;
use App\Form\ActivityFrontType;
use App\Form\UserType;
use App\Repository\ActivitiesRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/account')]
class AccountController extends AbstractController
{

    #[Route('/', name: 'account_index')]
    public function index(ActivitiesRepository $activitiesRepository): Response
    {
        //Récupère l'utilisateur
        $user = $this->getUser();

        $childrens = [
            [
                'name' => 'Jérome',
                'age_range' => '12-16'
            ]
        ];

        $activityPublished = $activitiesRepository->getactivityStatus($user->getId());
        $activityProjet = $activitiesRepository->getactivityStatus($user->getId(), 'projet');
        // dd($activityProjet);

        return $this->render('users/profil.html.twig', [
            'published' => $activityPublished,
            'projects' => $activityProjet,
            'childrens' => $childrens
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

    #[Route('/activity/new', name: 'activity_create', methods: ['GET', 'POST'])]
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

    #[Route('/activity/{id}/edit', name: 'activity_edit', methods: ['GET', 'POST'])]
    public function editActivity(Request $request, Activities $activity, ActivitiesRepository $activitiesRepository): Response
    {
        // -- Vérification des droits -- //
        // renvoie une 404 si user n'a pas le rôle Animateur
        $this->denyAccessUnlessGranted('ROLE_ANIMATEUR');

        // récupère idUser de l'activité et celle du user courant
        $idUserActivity = $activity->getUser()->getId();
        $userId = $this->getUser()->getId();

        // renvoie une 404 si l'idUser de l'activié n'est pas celui du user courant
        if($idUserActivity !== $userId) {
            throw $this->createAccessDeniedException();
        }
        // ----------- //

        $form = $this->createForm(ActivityFrontType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $activitiesRepository->add($activity);
            return $this->redirectToRoute('account_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('activites/edit.html.twig', [
            'activity' => $activity,
            'form' => $form,
        ]);
    }

    // Supprime une activité
    #[Route('/{id}', name: 'activity_delete', methods: ['POST'])]
    public function deleteActivity(Request $request, Activities $activity, ActivitiesRepository $activitiesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activity->getId(), $request->request->get('_token'))) {
            $activitiesRepository->remove($activity);
        }

        return $this->redirectToRoute('account_index', [], Response::HTTP_SEE_OTHER);
    }
}
