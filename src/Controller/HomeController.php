<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home_index')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/first-twig', name: 'home_twig')]
    public function twig(): Response
    {
        $uneVar = "bonjour";
        $uneAutre = 42;
        return $this->render('home/twig.html.twig',
            compact('uneVar', 'uneAutre')
        );
    }
}
