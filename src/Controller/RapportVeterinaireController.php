<?php
namespace App\Controller;
use App\Entity\RapportVeto;
use App\Form\RapportVetoFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RapportVeterinaireRepository;

class RapportVeterinaireController extends AbstractController
{
    #[Route('/rapportveterinaire/new1', name: 'app_rapportveterinairenew1')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $rapportVeterinaire = new RapportVeto();
        $form = $this->createForm(RapportVetoFormType::class, $rapportVeterinaire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($rapportVeterinaire);
            $em->flush();

            return $this->redirectToRoute('rapportveterinaire_success1');
        }

        return $this->render('rapportveterinaire/new.html.twig1', [
            'form' => $form->createView(),
        ]);
    }
    
    
    #[Route('/rapportveterinaire/success1', name:'rapportveterinaire_success1')]
    public function success(): Response
    {
        return $this->render('rapportveterinaire/success.html.twig1');
    }

    #[Route('/veterinaire/dashboard1', name:'veterinaire_dashboard1')]
    public function index(): Response
    {
        return $this->render('veterinaire/index.html.twig1');
    }
} 