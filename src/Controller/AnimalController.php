<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\Race;
use App\Entity\Habitat;
use App\Repository\AnimalRepository;
use App\Repository\RaceRepository;
use App\Repository\HabitatRepository;
use App\Repository\RapportVetoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AnimalController extends AbstractController
{
    
    
    #[Route('/animal', name: 'app_animal')]
     public function index(AnimalRepository $animalRepository, RaceRepository $raceRepository, HabitatRepository $habitatRepository, Request $request ): Response
    {
    
        $selectedRace = $request->query->get('race', '');
        $selectedHabitat = $request->query->get('habitat', '');

        $queryBuilder = $animalRepository->createQueryBuilder('a')
            ->leftJoin('a.race', 'r')
            ->leftJoin('a.habitat', 'h')
            ->addSelect('r')
            ->addSelect('h');

        if ($selectedRace) {
            $queryBuilder->andWhere('r.Nom = :race')
                ->setParameter('race', $selectedRace);
        }

        if ($selectedHabitat) {
            $queryBuilder->andWhere('h.Nom = :habitat')
                ->setParameter('habitat', $selectedHabitat);
        }

        $animaux = $queryBuilder->getQuery()->getResult();
        
        $races = $raceRepository->findAll();
        $habitats = $habitatRepository->findAll();

        return $this->render('animal/index.html.twig', [
            'animaux' => $animaux,
            'races' => $races,
            'habitats' => $habitats,
            'selectedRace' => $selectedRace,
            'selectedHabitat' => $selectedHabitat,
        ]);
       
    }

    #[Route('/animal/{id}', name: 'animal_show')]
    public function show(int $id, AnimalRepository $animalRepository, RapportVetoRepository $rapportVetoRepository, EntityManagerInterface $em): Response
    {
        $animal = $animalRepository->find($id);

        if (!$animal) {
            throw $this->createNotFoundException('Animal non trouvé');
        }

        $animal->incrementConsultation();
        $em->flush();

        $etat = '';
        $detailetatanimal = '';
        $rapportVeto = $rapportVetoRepository->findOneBy(['animal' => $animal]);

        if ($rapportVeto) {
            $etat = $rapportVeto->getEtat();
            $detailetatanimal = $rapportVeto->getDetailEtatAnimal();
        }

        return $this->render('animal/show.html.twig', [
            'animal' => $animal,
            'etat' => $etat,
            'detailetatanimal' => $detailetatanimal,
        ]);
    }
 
   
}