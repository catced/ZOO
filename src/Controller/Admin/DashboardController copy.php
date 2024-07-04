<?php

namespace App\Controller\Admin;

use App\Entity\Habitat;
use App\Entity\Metier;
use App\Entity\User;
use App\Entity\Service;
use App\Entity\Horaire;
use App\Entity\Animal;
use App\Entity\Race;
use App\Entity\RapportVeto;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();
        return $this->render('admin/dashboard.html.twig');
        
        
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ARCADIA');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-person', User::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-landmark', Service::class);
        yield MenuItem::linkToCrud('Habitats', 'fas fa-house', Habitat::class);
        yield MenuItem::linkToCrud('Métiers', 'fas fa-person', Metier::class);
        yield MenuItem::linkToCrud('Horaires', 'fas fa-clock', Horaire::class);
        yield MenuItem::linkToCrud('Animaux', 'fas fa-dog', Animal::class);
        yield MenuItem::linkToCrud('Races', 'fa-regular fa-heart', Race::class);
        yield MenuItem::linkToCrud('Rapport Vétérinaire', 'fa-solid fa-message', RapportVeto::class);
        yield MenuItem::linkToRoute('Statistiques des animaux', 'fas fa-chart-line', 'admin_animal_statistics');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
        //yield MenuItem::linkToDashboard('Back to the website', 'fas fa-home', 'homepage');
        yield MenuItem::linkToLogout('Déconnexion', 'fa fa-right-from-bracket');
    }
}
