<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Animal;
use App\Entity\Nourriture;
use App\Repository\AvisRepository;
use App\Repository\AnimalRepository;
use App\Repository\NourritureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

   /* 29/04 14:00 #[Route('/admin/User', name: 'app_admin_User')]
      
    public function ListUser(UserRepository $user){
        return $this ->render("admin/User.html.twig",[
            'User' => $user->findAll()
        ]);
    }*/
    // #[Route('/user/dashboard', name: 'user_dashboard')]
    // public function dashboard(): Response
    // {
    //     return $this->render('user/index.html.twig');
    // }
    #[Route('/user/dashboard', name: 'user_dashboard')]
    //public function dashboard(EntityManagerInterface $em): Response
    public function dashboard(AvisRepository $avisRepository, EntityManagerInterface $em, Request $request, NourritureRepository $nourritures): Response
    {
        //$avis = $em->getRepository(Avis::class)->findAll();
         $avisNonValides = $avisRepository->findNonValides('NULL');
        // //$avis = $avisRepository->findAll();
         $nourritures = $em->getRepository(Nourriture::class)->findAll();

        $avis = $avisRepository->findBy(['estVisible' => NULL]);
        // $showvalidated = $request->query->get('show_validated', 'false') === 'true';
    
        // if ($showvalidated) {
        //     $avis = $avisRepository->findAll();
        // } else {
           
        // }
        return $this->render('user/dashboard.html.twig', [
            'avis' => $avisNonValides,  //$avis,
            //'showvalidated' => $showvalidated,
            'nourritures' => $nourritures,
            ]);
    }

    #[Route('/user/validate_avis', name: 'validate_avis', methods: ['POST'])]
    public function validateAvis(Avis $avis, Request $request, EntityManagerInterface $em, AvisRepository $avisRepository): Response
    {
        // $avis->setEstVisible(true);
        // $em->persist($avis);
        // $em->flush();

        $avisIds = $request->request->all('avis');  //('avis', []);  //get
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

    #[Route('/user/add_nourriture', name: 'add_nourriture')]
    public function addNourriture(Request $request, EntityManagerInterface $em, AnimalRepository $animalRepository): Response
    {
       $animal = $em->getRepository(Animal::class)->findAll();
       $animals = $animalRepository->findAll();  //
      
        if ($request->isMethod('POST')) {
            // $animalid = $request->request->get('animal_id');
            // $animal = $animalRepository->find($animalid);

           //if ($animal) {
            $nourriture = new Nourriture();
            $nourriture->setType($request->request->get('type'));
            $nourriture->setDateHeure(new \DateTime($request->request->get('dateHeure')));
            $nourriture->setQuantite((int)$request->request->get('quantite'));
            //$nourriture->setAnimal($animal);
              
            $animalId = $request->request->get('animal_id');
            $animal = $em->getRepository(Animal::class)->find($animalId);
            $nourriture->setType($animal);
            $animaux = $animalRepository->findAll();  //

            $em->persist($nourriture);
            $em->flush();

            return $this->redirectToRoute('user_dashboard');
        // } else {
        // }
                  
        
        }
        return $this->render('user/add_nourriture.html.twig', [
            'animal' => $animalRepository->findAll(),
            'animals' => $animals,
            
        ]);
        
    }
       
        
}
   
   

