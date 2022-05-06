<?php

namespace App\Controller;

use App\Entity\Activities;
use App\Entity\Childrens;
use App\Form\ActivitiesType;
use App\Form\ActivityFrontType;
use App\Form\ChildrensFrontType;
use App\Form\UserType;
use App\Repository\ActivitiesRepository;
use App\Repository\ChildrensRepository;
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

        // Récupère enfant(s) de l'utilisateur
        $childrens = $user->getChildrens();

        $activityPublished = $activitiesRepository->getactivityStatus($user->getId());
        $activityProjet = $activitiesRepository->getactivityStatus($user->getId(), 'projet');

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
            return $this->redirectToRoute('account_index', [], Response::HTTP_SEE_OTHER);
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
    
    //***** CHILDRENS ***** //

    // Ajouter un enfant
    #[Route('/child/new', name: 'child_create', methods: ['GET', 'POST'])]
    public function newChild(Request $request, ChildrensRepository $childrensRepository): Response
    {
        $child = new Childrens();
        $form = $this->createForm(ChildrensFrontType::class, $child);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $child->setParent($this->getUser());
            $childrensRepository->add($child);
            return $this->redirectToRoute('account_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('childrens/new.html.twig', [
            'child' => $child,
            'form' => $form,
        ]);
    }

    // Modifier un enfant
    #[Route('/child/{id}/edit', name: 'child_edit', methods: ['GET', 'POST'])]
    public function editChild(Request $request, Childrens $child, ChildrensRepository $childrensRepository): Response
    {
        // -- Vérification des droits -- //
        // renvoie une 404 si user n'a pas le rôle Parent
        $this->denyAccessUnlessGranted('ROLE_PARENT');

        // récupère idParent de l'enfant et celle du user courant
        $idParentChild = $child->getParent()->getId();
        $userId = $this->getUser()->getId();

        // renvoie une 404 si idParent n'est pas celui du user courant
        if($idParentChild !== $userId) {
            throw $this->createAccessDeniedException();
        }
        // ----------- //

        $form = $this->createForm(ChildrensFrontType::class, $child);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $childrensRepository->add($child);
            return $this->redirectToRoute('account_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('childrens/edit.html.twig', [
            'child' => $child,
            'form' => $form,
        ]);
    }

    // Supprime un enfant
    #[Route('/child/{id}/delete', name: 'child_delete', methods: ['POST'])]
    public function deleteChild(Request $request, Childrens $child, ChildrensRepository $childrensRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$child->getId(), $request->request->get('_token'))) {
            $childrensRepository->remove($child);
        }

        return $this->redirectToRoute('account_index', [], Response::HTTP_SEE_OTHER);
    }
}
