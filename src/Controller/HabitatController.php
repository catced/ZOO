<?php

namespace App\Controller;

use App\Entity\Habitat;
use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class HabitatController extends AbstractController
{
    #[Route('/habitat', name: 'app_habitat')]
    public function index(HabitatRepository $habitatRepository, EntityManagerInterface $em): Response
    {
        // return $this->render('service/index.html.twig', [
        //     'controller_name' => 'ServiceController',
       // ]);
       $habitats = $em->getRepository(Habitat:: class)->findAll();

       return $this->render('habitat/index.html.twig', [
          'habitats' => $habitats,
        ]);
    }
}