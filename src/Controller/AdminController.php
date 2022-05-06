<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'app_admin')]
    public function index(UsersRepository $usersRepository): Response
    {
        return $this->render('admin/dashboard.html.twig', [
            'usersAnimateurs' => $usersRepository-> findAllUser('["ROLE_ANIMATEUR"]'),
            'usersParents' => $usersRepository->findAllUser('["ROLE_PARENT"]'),
            'controller_name' => 'AdminController',
        ]);
    }

   
}
