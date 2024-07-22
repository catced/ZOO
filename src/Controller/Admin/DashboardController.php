<?php

namespace App\Controller\Admin;

use App\Entity\Habitat;
use App\Entity\Metier;
use App\Entity\User;
use App\Entity\Service;
use App\Entity\Horaire;
use App\Entity\Animal;
use App\Entity\Race;
use App\Entity\Nourriture;
use App\Entity\TypeNourriture;
use App\Entity\RapportVeto;
use App\Form\HoraireType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\AnimalRepository;
use App\Repository\UserRepository;
use App\Repository\HoraireRepository;
use App\Repository\RapportVetoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractDashboardController 
{
    
    private $animalRepository;
    private $rapportVetoRepository;
    private $userRepository;
    
    public function __construct(AnimalRepository $animalRepository, RapportVetoRepository $rapportVetoRepository, UserRepository $userRepository)
   {
  
        $this->animalRepository = $animalRepository;
        $this->rapportVetoRepository = $rapportVetoRepository;
        $this->userRepository = $userRepository;
    }
    
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        //pour récupérer la liste des animaux et des rapports vétérinaire
        $rapportsVeto = $this->rapportVetoRepository->findBy([], ['datepassage' => 'DESC']);
        $animalStats = $this->animalRepository->findBy([], ['consultation' => 'DESC']);
       
        return $this->render('admin/dashboard.html.twig',[
            'animalStats' => $animalStats,
            'rapportsVeto' => $rapportsVeto,
        ]);
             
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ARCADIA');
    }

    public function configureMenuItems(): iterable
    {
        //menus disponibles
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-person', User::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-landmark', Service::class);
        yield MenuItem::linkToCrud('Habitats', 'fas fa-house', Habitat::class);
        yield MenuItem::linkToCrud('Métiers', 'fas fa-person', Metier::class);
        yield MenuItem::linkToCrud('Horaires', 'fas fa-clock', Horaire::class);
        yield MenuItem::linkToCrud('Animaux', 'fas fa-dog', Animal::class);
        yield MenuItem::linkToCrud('Races', 'fa-regular fa-heart', Race::class);
        yield MenuItem::linkToCrud('Type de nourriture', 'fa-solid fa-plate-wheat', TypeNourriture::class);
        yield MenuItem::linkToRoute('Consulter les rapports vétérinaires', 'fa fa-file-alt', 'consult_rapport_veto');
        yield MenuItem::linkToCrud('Nourriture', 'fa-solid fa-utensils', Nourriture::class);
        yield MenuItem::linkToLogout('Déconnexion', 'fa fa-right-from-bracket');
    }

    #[Route('/admin/statistics', name: 'admin_animal_statistics')]
    #[IsGranted('ROLE_ADMIN')]
    //Stat des animaux
    public function animalStatistics(AnimalRepository $animalRepository): Response
    {
        $animaux = $animalRepository->findAll();

        return $this->render('admin/statistics.html.twig', [
            'animaux' => $animaux,
        ]);
    }

    #[Route('/admin/consultRapportVeto', name: 'consult_rapport_veto')]
    #[IsGranted('ROLE_ADMIN')]
    public function consultRapportVeto(Request $request, RapportVetoRepository $rapportVetoRepository, AnimalRepository $animalRepository, UserRepository $userRepository): Response
    {
        $date = $request->query->get('date');
        $animalId = $request->query->get('animal');
        $veterinaireId = $request->query->get('veterinaire');

        $queryBuilder = $rapportVetoRepository->createQueryBuilder('r')
            ->leftJoin('r.animal', 'a')
            ->leftJoin('r.veterinaire', 'v')
            ->addSelect('a', 'v');
        //Consitution des filtres
        if ($animalId) {
            $queryBuilder->andWhere('a.id = :animalId')
                         ->setParameter('animalId', $animalId);
        }

        if ($veterinaireId) {
            $queryBuilder->andWhere('v.id = :veterinaireId')
                         ->setParameter('veterinaireId', $veterinaireId);
        }

        if ($date) {
            $queryBuilder->andWhere('DATE_FORMAT(r.datepassage, \'%d/%m/%Y\ = :date')
                         ->setParameter('date', $date);
        }

        $rapportsVeto = $queryBuilder->getQuery()->getResult();

        // Récupérer tous les animaux et vétérinaires pour les filtres
        $animals = $animalRepository->findAll();
        $veterinaires = $userRepository->findByRole('ROLE_VETERINAIRE');


        return $this->render('admin/consult_rapport_veto.html.twig', [
            'animals' => $animals,
            'veterinaires' => $veterinaires,
            'rapportsVeto' => $rapportsVeto,
        ]);
    }

    #[Route('/admin/horaires', name: 'admin_horaires')]
    #[IsGranted('ROLE_ADMIN')]
    public function manageHoraires(Request $request, EntityManagerInterface $entityManager, HoraireRepository $horaireRepository): Response
    {
        $horaire = new Horaire();
        $form = $this->createForm(HoraireType::class, $horaire);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $existingHoraire = $horaireRepository->findOneBy(['Jour' => $horaire->getJour()]);
            dump($existingHoraire);
            if ($existingHoraire) {
                $this->addFlash('error', 'Jour déjà créé.');
            } else {
                if ($horaire->getMatinFin() === null) {
                    $horaire->setMatinFin(null);
                }
                if ($horaire->getAmFin() === null) {
                    $horaire->setAmFin(null);
                }

                if ($horaire->getMatinDeb() === null) {
                    $horaire->setMatinDeb(null);
                }
                if ($horaire->getAmDeb() === null) {
                    $horaire->setAmDeb(null);
                }

                $entityManager->persist($horaire);
                $entityManager->flush();

               return $this->redirectToRoute('admin_horaires');
            }
        }

        return $this->render('admin/horaires.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
    

