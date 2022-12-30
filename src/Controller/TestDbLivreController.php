<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\Livre;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestDbLivreController extends AbstractController
{
    #[Route('/test/db/livre', name: 'app_test_db_livre')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $livreRepository = $doctrine->getRepository(Livre::class);
        $auteurRepository = $doctrine->getRepository(Auteur::class);

        // - la liste des livres dont le titre contient le mot clé `doloribus`
        $livres = $livreRepository->findByTitre('doloribus');
        dump($livres);
        
        // - la liste des livres dont l'id de l'auteur est `1`
        $auteur = $auteurRepository->find(1);
        $livres = $livreRepository->findByAuteur($auteur);
        dump($livres);

        // - la liste des livres dont le genre contient le mot clé `roman`
        $livres = $livreRepository->findByNomGenre('roman');

        foreach ($livres as $livre) {
            dump($livre->getTitre());

            foreach ($livre->getGenres() as $genre) {
                dump($genre->getNom());
            }
        }

        exit();
    }
}
