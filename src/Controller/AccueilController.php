<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig');
    }

    #[Route('/animal', name: 'animal')]
    public function animal(): Response
    {
        return $this->render('animal/index.html.twig');
    }
    
    #[Route('/habitat', name: 'habitat')]
    public function habitat(): Response
    {
        return $this->render('habitat/index.html.twig');
    }

    #[Route('/service', name: 'service')]
    public function service(): Response
    {
        return $this->render('service/index.html.twig');
    }

    #[Route('/horaire', name: 'horaire')]
    public function about(): Response
    {
        return $this->render('horaire/index.html.twig');
    }

    #[Route('/contact', name: 'contact')]
    //public function contact(): Response
    // {
    //     return $this->render('avis/dashboard.html.twig');
    // }
    public function contact(Request $request, EntityManagerInterface $em): Response
    {
        $avis = new Avis();
        $form = $this->createForm(AvisFormType::class, $avis);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($avis);
            $em->flush();

            $this->addFlash('success', 'Votre avis a été envoyé avec succès!');

            return $this->redirectToRoute('avis');
        }

        return $this->render('avis/avis.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
