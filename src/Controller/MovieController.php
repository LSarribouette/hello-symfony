<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movie', name: 'movie')]
class MovieController extends AbstractController
{
    #[Route('/', name: '_list')]
    public function list(
        MovieRepository $movieRepository
    ): Response
    {
        $movies = $movieRepository->findAll();
        dump($movies);
        return $this->render('movie/list.html.twig',
            compact('movies')
        );
    }

    #[Route('/{id}', name: '_detail')]
    public function detail(
        Movie $id,
        MovieRepository $movieRepository
    ): Response
    {
        $movie = $movieRepository->find($id);
        return $this->render('movie/detail.html.twig',[
            'movie' => $id
        ]);
    }

    #[Route('/create', name: '_create')]
    public function create(
        EntityManagerInterface $entityManager
    ): Response
    {
        // a transformer en formulaire
        $movie = (new Movie())
            ->setTitle("Vol au-dessus d'un nid de coucou")
            ->setReleaseYear(1975)
            ->setCountry("Etats-Unis")
            ->setWasSeen(false);
        $entityManager->persist($movie);
        $entityManager->flush();
        return $this->render('movie/create.html.twig',
            compact('movie')
        );
    }

}
