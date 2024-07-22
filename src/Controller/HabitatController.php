<?php

namespace App\Controller;

use App\Entity\Habitat;
use App\Repository\HabitatRepository;
use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class HabitatController extends AbstractController
{
    #[Route('/habitat', name: 'app_habitat')]
    public function index(HabitatRepository $habitatRepository, EntityManagerInterface $em): Response
    {
       
       $habitats = $em->getRepository(Habitat:: class)->findAll();

       return $this->render('habitat/index.html.twig', [
          'habitats' => $habitats,
        ]);
    }

    // Montre les animaux par habitats
    #[Route('/habitat/{id}', name: 'animal_habitat')]
    public function show(int $id, AnimalRepository $animalRepository, EntityManagerInterface $em): Response
    {
        $habitat = $em->getRepository(Habitat::class)->find($id);

        if (!$habitat) {
            throw $this->createNotFoundException('Il n\'existe pas d\'habitat.');
        }

        $animals = $animalRepository->findBy(['habitat' => $habitat]);

        return $this->render('habitat/animalparhabitat.html.twig', [
            'habitat' => $habitat,
            'animals' => $animals,
        ]);
    }
}