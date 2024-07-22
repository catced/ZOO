<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Animal;
use App\Entity\Nourriture;
use App\Entity\User;
use App\Entity\TypeNourriture;
use App\Repository\AvisRepository;
use App\Repository\AnimalRepository;
use App\Repository\NourritureRepository;
use App\Repository\TypeNourritureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    #[IsGranted('ROLE_EMPLOYE')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    //Tableau de bord employé
    #[Route('/user/dashboard', name: 'user_dashboard')]
    #[IsGranted('ROLE_EMPLOYE')]
    public function dashboard(AvisRepository $avisRepository, EntityManagerInterface $em, Request $request, NourritureRepository $nourritures): Response
    {
        //affichages des avis non validés afin que l'employé puisse les valider
         $avisNonValides = $avisRepository->findNonValides('NULL');
        
         $nourritures = $em->getRepository(Nourriture::class)->findAll();

        $avis = $avisRepository->findBy(['estVisible' => NULL]);
        
        return $this->render('user/dashboard.html.twig', [
            'avis' => $avisNonValides,  
            'nourritures' => $nourritures,
            ]);
    }

    #[Route('/user/validate_avis', name: 'validate_avis', methods: ['POST'])]
    public function validateAvis(Avis $avis, Request $request, EntityManagerInterface $em, AvisRepository $avisRepository): Response
    {
       
        $avisIds = $request->request->all('avis');  
        if (!empty($avisIds)) {
            $avisToValidate = $avisRepository->findBy(['id' => $avisIds]);
            foreach ($avisToValidate as $avis) {
                $avis->setEstVisible(true);
                $em->persist($avis);
            }
            $em->flush();
        }
        return $this->redirectToRoute('user_dashboard');
    }

    //ajout de nourriture pas employé
    #[Route('/user/add_nourriture', name: 'add_nourriture')]
    public function addNourriture(Request $request, EntityManagerInterface $em, AnimalRepository $animalRepository,TypeNourritureRepository $typeNourritureRepository): Response
    {
       $animal = $em->getRepository(Animal::class)->findAll();
       $animals = $animalRepository->findAll();  //
       $nourritures = $em->getRepository(Nourriture::class)->findAll();
       
       $typeNourritures = $typeNourritureRepository->findAll(); 
       
        if ($request->isMethod('POST')) {
            $animalId = $request->request->get('animal_id');
            $typeId = $request->request->get('type_nourriture_id');
            $dateHeure = $request->request->get('dateHeure');
            $quantite = $request->request->get('quantite');

            $animal = $em->getRepository(Animal::class)->find($animalId);
         
            $typeNourriture = $em->getRepository(TypeNourriture::class)->find($typeId);


            if ($animal) {
                $nourriture = new Nourriture();
                $nourriture->setAnimal($animal);
                $nourriture->setType($typeNourriture);
                $nourriture->setDateHeure(new \Datetime($dateHeure));
                $nourriture->setQuantite($quantite);

                $em->persist($nourriture);
                $em->flush();

                return $this->redirectToRoute('add_nourriture');
            }
        }

        return $this->render('user/add_nourriture.html.twig', [
            'animals' => $animals,
            'nourritures' => $nourritures,
            'typenourritures' => $typeNourritures,
        ]);
    }
       
   
        
}
   
   

