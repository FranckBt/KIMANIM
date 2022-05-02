<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route ('/animateur')]
class AnimateurController extends AbstractController
{
    #[Route('/', name: 'app_users')]
    public function index(): Response
    {
        // $user = $this->getUser();
        return $this->render('users/index.html.twig', [
            // 'user' => $user,
        ]);
    }
}
