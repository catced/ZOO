<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use App\Entity\Veterinaire;
use App\Entity\RapportVeto;
use App\Form\RapportVetoFormType;
use App\Repository\AnimalRepository;
use App\Repository\RapportVetoRepository;

use Doctrine\ORM\EntityManagerInterface;

class VetoController extends AbstractController
{
    // #[Route('/avis', name: 'app_avis')]
    // public function index(Avis $avis): Response
    // {
    //     return $this->render('avis/index.html.twig', [
    //         'controller_name' => 'AvisController',
    //         'avis' => $avis,
    //     ]);
    // }

    #[Route('/veterinaire', name: 'app_veterinaire')]

       public function index(): Response
    {
        return $this->render('veterinaire/dashboard.html.twig', [
            'controller_name' => 'VetoController',
           // 'avis' => $avis,
        ]);
    }
   
   
    #[Route('/veterinaire/rapportveto', name: 'veterinaire_rapportveto')]
    public function rapport(Request $request, AnimalRepository $animalRepository): Response
    {
        $rapport = new RapportVeto();
        $form = $this->createForm(RapportVetoFormType::class, $rapport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rapport);
            $entityManager->flush();

            return $this->redirectToRoute('veterinaire_rapportveto');
        }

        return $this->render('veterinaire/rapportveto.html.twig', [
            'form' => $form->createView(),
        ]);
    }

        // public function newavis(Request $request, PersistenceManagerRegistry $doctrine): Response
        // {
        //     $avis = new avis;
        //     $form = $this->createForm(AvisFormType::class, $avis);
        //     $form->handleRequest($request);

        //     if ($form->isSubmitted() && $form->isValid()) {
        //         $em = $doctrine->getManager();   //$this->
        //         $avis ->setCreele(new \DateTime());
        //         $em->persist($avis);
        //         $em->flush();

        //         $this->addFlash('Succes','Votre avis est enregistré avec succès. Merci');
        //         return $this->redirectToRoute('accueil');
        //     }
        //     // return $this ->render('avis/avis.html.twig',[
            
        //     //     'form' => $form->createView()
        //     // ]);
        //      // Récupérer les 20 derniers avis
        //         $avisRepository = $doctrine->getRepository(Avis::class);
        //        $lastAvis = $avisRepository->findBy(
        //             ['estVisible' => true], 
        //             ['id' => 'DESC'], 
        //             20);

        //         return $this->render('avis/avis.html.twig', [
        //             'form' => $form->createView(),
        //             'avis_list' => $lastAvis,
        //         ]);
        //}
    
}
