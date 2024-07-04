<?php

// namespace App\Controller;

// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Attribute\Route;

// class NourritureController extends AbstractController
// {
//     #[Route('/nourriture', name: 'app_nourriture')]
//     public function index(): Response
//     {
//         return $this->render('nourriture/index.html.twig', [
//             'controller_name' => 'NourritureController',
//         ]);
//     }
// }


namespace App\Controller;

use App\Entity\Nourriture;
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

    #[Route('/employe/nourriture/add', name: 'add_nourriture')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        if ($request->isMethod('POST')) {
            $nourriture = new Nourriture();
            $nourriture->setType($request->request->get('type'));
            $nourriture->setDateHeure(new \DateTime($request->request->get('dateHeure')));
            $nourriture->setQuantite($request->request->get('quantite'));

            $em->persist($nourriture);
            $em->flush();

            return $this->redirectToRoute('employe_nourriture');
        }

        return $this->render('employe/add_nourriture.html.twig');
    }
}