<?php

namespace App\Controller\Admin;

use App\Entity\RapportVeto;
use App\Entity\User;
use App\Repository\RapportVetoRepository;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\DateTimeFilter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class RapportVetoCrudController extends AbstractCrudController
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }
    
    public static function getEntityFqcn(): string
    {
        return RapportVeto::class;
    }

    public function createEntity(string $entityFqcn)
    {
        $rapportVeto = new RapportVeto();

        // Get the current user
        $user = $this->tokenStorage->getToken()->getUser();

        // Check if the user is an instance of UserInterface
        if ($user instanceof UserInterface) {
            $rapportVeto->setVeterinaire($user);
        }

        return $rapportVeto;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Rapport Vétérinaire')
            ->setEntityLabelInPlural('Rapports Vétérinaires')
            ->showEntityActionsInlined();
    }

   
    
    public function configureFields(string $pageName): iterable
    {
    //    yield AssociationField::new('animal');
    //    yield TextField::new('DetailEtatAnimal');
    //    yield TextField::new('Etat');
    //    yield DateField::new('Datepassage');
    //    yield IdField::new('Id')->hideOnForm();
        if (Crud::PAGE_NEW === $pageName) {
            return [
                AssociationField::new('animal'),
                TextField::new('DetailEtatAnimal'),
                TextField::new('Etat'),
                DateField::new('Datepassage'),
                IdField::new('Id')->hideOnForm(),
            ];
        }

        return [
            AssociationField::new('animal'),
            TextField::new('DetailEtatAnimal'),
            TextField::new('Etat'),
            DateField::new('Datepassage'),
            AssociationField::new('veterinaire')->setDisabled(), // Make field read-only
            IdField::new('Id')->hideOnForm(),
        ];
      
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('animal')->setLabel('Animal'))
            ->add(EntityFilter::new('veterinaire')->setLabel('Vétérinaire'))
            ->add(DateTimeFilter::new('datepassage')->setLabel('Date de passage'));
    }

    
   
    
}
