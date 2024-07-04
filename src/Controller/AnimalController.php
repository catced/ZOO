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

    // #[Route('/animal/{id}', name: 'app_nbanimalindex')]
    // //    /**
    // //  * @Route("/animal/{id}", name="animal_show")
    // //  */
    // public function show(Animal $animal, EntityManagerInterface $entityManager): Response
    // {
    //     // Incrémenter le champ consultations
    //     $animal->incrementConsultation();
    //     $entityManager->persist($animal);
    //     $entityManager->flush();

    //     return $this->render('animal/nbAnimal.html.twig', [
    //         'animal' => $animal,
    //     ]);
    // }
}