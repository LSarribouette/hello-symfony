<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/movie', name: 'movie')]
class MovieController extends AbstractController
{
    #[Route('/create', name: '_create')]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {
        $movie = new Movie();
        $movieForm = $this->createForm(MovieFormType::class, $movie);
        $movieForm->handleRequest($request);
        if ($movieForm->isSubmitted()) {
            $entityManager->persist($movie);
            $entityManager->flush();
            $this->addFlash('success', 'Film ajouté à la liste !');
            return $this->redirectToRoute('movie_list');
        }
        return $this->render('movie/create.html.twig',
            compact('movieForm')
        );
    }

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
}
