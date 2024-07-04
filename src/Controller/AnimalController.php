<?php
// src/Controller/AnimalController.php

namespace App\Controller;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class AnimalController extends AbstractController
{
    #[Route('/animal', name: 'app_animal')]
    public function index(AnimalRepository $animalRepository): Response
    {
        $animaux = $animalRepository->findBy([], ['race' => 'ASC']); // Tri par race

        return $this->render('animal/index.html.twig', [
            'animaux' => $animaux,
        ]);
    }

    #[Route('/animal/{id}', name: 'app_animal_show')]
    public function show(Animal $animal, EntityManagerInterface $entityManager): Response
    {
        $animal->incrementConsultation();
        $entityManager->persist($animal);
        $entityManager->flush();

        return $this->render('animal/show.html.twig', [
            'animal' => $animal,
        ]);
    }
}
