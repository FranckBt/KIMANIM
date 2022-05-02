<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserType;
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

    #[Route('/update', name: 'app_account_update', methods: ['GET', 'POST'])]
    public function edit(Request $request, UsersRepository $userRepository): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user);
            return $this->redirectToRoute('app_account_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('users/update.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
}
