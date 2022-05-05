<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultFrontController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function home(): Response
    {
        return $this->render('defaultfront/home.html.twig', [
        ]);
    }

    #[Route('/faq', name: 'faq')]
    public function faq(): Response
    {
        return $this->render('defaultfront/faq.html.twig', [
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('defaultfront/contact.html.twig', [
        ]);
    }

    #[Route('/mentions_legales', name: 'mentions')]
    public function mentions(): Response
    {
        return $this->render('defaultfront/mentions.html.twig', [
        ]);
    }
}
