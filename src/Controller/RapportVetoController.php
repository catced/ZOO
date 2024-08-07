<?php

namespace App\Controller;

use App\Entity\RapportVeto;
use App\Form\RapportVetoFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RapportVetoController extends AbstractController
{
    #[Route('/veterinaire/rapportvetonew1', name: 'veterinaire_rapportvetonew1')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $rapportVeto = new RapportVeto();
        $form = $this->createForm(RapportVetoFormType::class, $rapportVeto);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($rapportVeto);
            $em->flush();

            return $this->redirectToRoute('rapportveto_success1');
        }

        return $this->render('veterinaire/rapportVetoNew.html.twig1', [
            'form' => $form->createView(),
        ]);
    }
    
    
    #[Route('/rapportveto/success1', name:'rapportveto_success1')]
    public function success(): Response
    {
        return $this->render('rapportveto/success.html.twig1');
    }

   
} 