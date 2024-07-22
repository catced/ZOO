<?php

namespace App\Controller\Admin;

use App\Entity\TypeNourriture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TypeNourritureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TypeNourriture::class;
    }

    // public function configureActions(Actions $actions): Actions
    // {
    //     return $actions
    //         ->add(Crud::PAGE_EDIT, Action::INDEX)
    //         ->add(Crud::PAGE_INDEX, Action::DETAIL)
    //         ->add(Crud::PAGE_EDIT, Action::DETAIL)
    //         ;
    // }

    
    public function configureFields(string $pageName): iterable
    {
       
       yield IdField::new('Id')->hideOnForm();
       yield TextField::new('libelle');
                 
            ;
       
    }
}
