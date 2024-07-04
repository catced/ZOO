<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class AnimalController extends AbstractController
{
    #[Route('/animal', name: 'app_animal')]
    public function index(AnimalRepository $animalRepository, EntityManagerInterface $em): Response
    {
        // return $this->render('service/index.html.twig', [
        //     'controller_name' => 'ServiceController',
       // ]);
       $animaux = $animalRepository->findAll();
       
       return $this->render('animal/index.html.twig', [
          'animaux' => $animaux,
        ]);
       
    }
}