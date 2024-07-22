<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiaporamaController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(): Response
    {
        // Affiche des images pour la page d'accueil. Liste des fichiers dans le répertoire images/accueil
        $imagesDir = $this->getParameter('kernel.project_dir') . '/public/images/accueil';
        $images = array_diff(scandir($imagesDir), ['..', '.']);
        
        return $this->render('accueil/index.html.twig', [
            'images' => $images,
        ]);
    }
}
