<?php

namespace App\Controller\Admin;

use App\Entity\Nourriture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Action, Actions, Crud, KeyValueStore};
use Symfony\Component\Form\{FormBuilderInterface, FormEvent, FormEvents};


class NourritureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Nourriture::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_EDIT, Action::INDEX)
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->add(Crud::PAGE_EDIT, Action::DETAIL)
            ;
    }

    
    public function configureFields(string $pageName): iterable
    {
      
       yield IdField::new('Id')->hideOnForm();
       yield TextField::new('Type');
      
    }
    
}