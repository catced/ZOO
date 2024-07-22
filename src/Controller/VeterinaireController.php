<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use App\Entity\Nourriture;
use App\Entity\User;
use App\Entity\Animal;
use App\Entity\RapportVeto;
use App\Repository\RapportVetoRepository;
use App\Repository\AnimalRepository;
use App\Repository\UserRepository;
use App\Entity\TypeNourriture;
use App\Form\RapportVetoFormType;
use App\Repository\TypeNourritureRepository;
use App\Repository\NourritureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;


class VeterinaireController extends AbstractController
{
  
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
   // tableau de bord Veterinaire
   
    #[Route('/veterinaire/dashboard', name: 'veterinaire_dashboard')]
    #[IsGranted('ROLE_VETERINAIRE')]
    public function dashboard(RapportVetoRepository $rapportVetoRepository, Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        // $this->denyAccessUnlessGranted('ROLE_VETERINAIRE');
        // $user = $this->getUser();

        // if ($user) {
        //     $dbUser = $userRepository->findOneBy(['email' => $user->getUsername()]);
        //     if ($dbUser) {
        //         $roles = $dbUser->getRoles();
        //         dump($roles); 
        //     }
        // }
        $rapports = $rapportVetoRepository->findAll();
        return $this->render('veterinaire/dashboard.html.twig', [
            'rapports' => $rapports,
        ]);
      
    }
    // permet d'ajouter un nouveau rapport vétérinaire
    #[Route('/veterinaire/rapportVetoNew', name: 'veterinaire_rapportVeterinaireNew')]
    public function newRapportVeto(Request $request, EntityManagerInterface $em, AnimalRepository $animalRepository, TypeNourritureRepository $typeNourritureRepository,RapportVetoRepository $rapportVetoRepository): Response
    {
        // $this->denyAccessUnlessGranted('ROLE_VETERINAIRE');
    
       $animals = $animalRepository->findAll();  //
    
       $typeNourritures = $typeNourritureRepository->findAll(); 
 
    if ($request->isMethod('POST')) {
        $animalId = $request->request->get('animal_id');
        $typeId = $request->request->get('type_nourriture_id');
        $datePassage = $request->request->get('datePassage');
        $grammage = $request->request->get('grammage');
        $etat = $request->request->get('etat');
        $detailEtatAnimal = $request->request->get('detailEtatAnimal');

        $user = $this->getUser();
            
        if ($animalId && $typeId && $datePassage && $grammage && $etat && $detailEtatAnimal && $user) {
            $animal = $em->getRepository(Animal::class)->find($animalId);
            $typeNourriture = $em->getRepository(TypeNourriture::class)->find($typeId);

            if ($animal && $typeNourriture) {
                $rapport = new RapportVeto();
                $rapport->setAnimal($animal);
                $rapport->setTypeNourriture($typeNourriture);
                $rapport->setDatePassage(new \DateTime($datePassage));
                $rapport->setGrammage($grammage);
                $rapport->setEtat($etat);
                $rapport->setDetailEtatAnimal($detailEtatAnimal);
                $rapport->setVeterinaire($user);
              
                $em->persist($rapport);
                $em->flush();

                return $this->redirectToRoute('veterinaire_dashboard');
            }
        } else {
            $this->addFlash('error', 'Tous les champs sont obligatoires.');
           
        }
    }

        return $this->render('veterinaire/rapportvetonew.html.twig', [
          
            'animals' => $animals,
            'typenourritures' => $typeNourritures,
        ]);
    }
    
        
    // veterinaire visualise la nourriture donnée par l'employé
    #[Route('/veterinaire/alimentation', name: 'veterinaire_alimentation')]
    public function alimentation(Request $request): Response
    {
        // $this->denyAccessUnlessGranted('ROLE_VETERINAIRE');

        $animalId = $request->query->get('animal_id');
        $repository = $this->doctrine->getRepository(Nourriture::class);

        if ($animalId) {
            $nourritures = $repository->findBy(['animal' => $animalId]);
        } else {
            $nourritures = $repository->findAll();
        }

        $animals = $this->doctrine->getRepository(Animal::class)->findAll();

        return $this->render('veterinaire/alimentation.html.twig', [
            'nourritures' => $nourritures,
            'animals' => $animals,
            'selectedAnimal' => $animalId,
        ]);
    }
       
    #[Route('/veterinaire/consult_rapport', name: 'veterinaire_consultCR')]
    
    public function index(RapportVetoRepository $rapportVetoRepository, Request $request): Response
    {
       // $this->denyAccessUnlessGranted('ROLE_VETERINAIRE');
        
        $rapports = $rapportVetoRepository->findAll();
        return $this->render('veterinaire/consult_rapport.html.twig', [
            'rapports' => $rapports,
        ]);
      
    }
        
    
}
