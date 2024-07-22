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
use App\Repository\RapportVetoRepository;

class EmployeController extends AbstractController
{
    #[Route('/user/dashboard', name: 'user_dashboard')]
    
    public function dashboard(AvisRepository $avisRepository, EntityManagerInterface $em, Request $request, NourritureRepository $nourritures): Response
    {
       
         $avisNonValides = $avisRepository->findNonValides('NULL');
     
         $nourritures = $em->getRepository(Nourriture::class)->findAll();

        $avis = $avisRepository->findBy(['EstVisible' => NULL]);
        
        return $this->render('user/dashboard.html.twig', [
            'avis' => $avisNonValides,  
           
            'nourritures' => $nourritures,
            ]);
    }

  
   //validation des avis déposés par le visiteur 
    #[Route('/user/validate_avis', name: 'validate_avis', methods: ['POST'])]
    public function validateAvis(Avis $avis, Request $request, EntityManagerInterface $em, AvisRepository $avisRepository): Response
    {
        $avisIds = $request->request->all('avis');  
        if (!empty($avisIds)) {
            $avisToValidate = $avisRepository->findBy(['Id' => $avisIds]);
            foreach ($avisToValidate as $avis) {
                $avis->setEstVisible(true);
                $em->persist($avis);
            }
            $em->flush();
        }
        return $this->redirectToRoute('user_dashboard');
    }
    public function index(RapportVetoRepository $rapportVetoRepository): Response
    {
        $rapports = $rapportVetoRepository->findAll();

        return $this->render('employe/index.html.twig', [
            'rapports' => $rapports,
        ]);

   
        
    }
}