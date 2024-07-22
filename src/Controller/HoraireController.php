<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\HoraireRepository;
use App\Entity\Horaire;
use Symfony\Component\HttpFoundation\Request;
use App\Form\HoraireType;

class HoraireController extends AbstractController
{
    #[Route('/horaire', name: 'app_horaire')]
    public function index(HoraireRepository $horaireRepository): Response
    {
        $horaires = $horaireRepository->findAll();
        
        $uniqueHoraires = [];
        foreach ($horaires as $horaire) {
            if (!isset($uniqueHoraires[$horaire->getJour()])) {
                $uniqueHoraires[$horaire->getJour()] = $horaire;
            }
        }

        // affichage des horaires
        return $this->render('horaire/index.html.twig', [
            
            'horaires' => $uniqueHoraires,
        ]);
       
    }

    

   
}
