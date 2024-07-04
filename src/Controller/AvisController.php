<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use App\Form\AvisFormType;
use App\Entity\Avis;
use Doctrine\ORM\EntityManagerInterface;

class AvisController extends AbstractController
{
    // #[Route('/avis', name: 'app_avis')]
    // public function index(Avis $avis): Response
    // {
    //     return $this->render('avis/index.html.twig', [
    //         'controller_name' => 'AvisController',
    //         'avis' => $avis,
    //     ]);
    // }

    #[Route('/newavis', name: 'app_newavis')]
   

        public function newavis(Request $request, PersistenceManagerRegistry $doctrine): Response
        {
            $avis = new avis;
            $form = $this->createForm(AvisFormType::class, $avis);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $doctrine->getManager();   //$this->
                $avis ->setCreele(new \DateTime());
                $em->persist($avis);
                $em->flush();

                $this->addFlash('Succes','Votre avis est enregistré avec succès. Merci');
                return $this->redirectToRoute('accueil');
            }
            // return $this ->render('avis/avis.html.twig',[
            
            //     'form' => $form->createView()
            // ]);
             // Récupérer les 20 derniers avis
                $avisRepository = $doctrine->getRepository(Avis::class);
               $lastAvis = $avisRepository->findBy(
                    ['estVisible' => true], 
                    ['id' => 'DESC'], 
                    20);

                return $this->render('avis/avis.html.twig', [
                    'form' => $form->createView(),
                    'avis_list' => $lastAvis,
                ]);
        }
    
}
