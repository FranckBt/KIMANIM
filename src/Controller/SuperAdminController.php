<?php

namespace App\Controller;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/superadmin')]
class SuperAdminController extends AbstractController
{
    #[Route('/gestionadmin', name: 'app_superadmin', methods: ['GET'])]
    public function parentindex(UsersRepository $usersRepository): Response
    {
        return $this->render('admin/admingestion.html.twig', [
           'users' => $usersRepository->findAllUser('["ROLE_ADMIN"]'),
            'titreTable' => 'Admin'
        ]);
    }

   
}
