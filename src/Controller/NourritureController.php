<?php

namespace App\Controller;

use App\Entity\Nourriture;
use App\Entity\TypeNourriture;
use App\Repository\TypeNourritureRepository;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NourritureController extends AbstractController
{
    #[Route('/employe/nourriture', name: 'employe_nourriture')]
    public function index(EntityManagerInterface $em): Response
    {
        $nourritures = $em->getRepository(Nourriture::class)->findAll();

        return $this->render('employe/nourriture.html.twig', ['nourritures' => $nourritures]);
    }

    //Ajout de nourriture par employé à un animal
    #[Route('/employe/nourriture/add', name: 'add_nourriture')]
    public function add(Request $request, EntityManagerInterface $em, TypeNourritureRepository $typeNourritureRepository, AnimalRepository $animalRepository): Response
  
    {
        $animals = $animalRepository->findAll();
        $typeNourritures = $typeNourritureRepository->findAll();


        if ($request->isMethod('POST')) {
            $nourriture = new Nourriture();
            $nourriture->setType($request->request->get('type'));
            $nourriture->setDateHeure(new \DateTime($request->request->get('dateHeure')));
            $nourriture->setQuantite($request->request->get('quantite'));
       
            $em->persist($nourriture);
            $em->flush();

            return $this->redirectToRoute('user_nourriture');
        }

        return $this->render('user/add_nourriture.html.twig');
    }
}