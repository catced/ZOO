<?php

namespace App\Controller\Admin;

use App\Entity\Habitat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Action, Actions, Crud, KeyValueStore};
use Symfony\Component\Form\{FormBuilderInterface, FormEvent, FormEvents};


class HabitatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Habitat::class;
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
       /* $fields = [
            IdField::new('Habitat_Id')->hideOnForm(),
            TextField::new('Nom','Nom'),
            TextField::new('Description','Description '),
            //TextField::new('password'),
            TextField::new('CommentaireHabitat','Commentaire Habitat')
            ];*/
       yield IdField::new('Id')->hideOnForm();
       yield TextField::new('CodeHab');
       yield TextField::new('Nom');
       yield TextField::new('Description');
       yield TextEditorField::new('CommentaireHabitat');
           
            ;
       // $fields[] = $password;

       // return $fields;
    }
    
}