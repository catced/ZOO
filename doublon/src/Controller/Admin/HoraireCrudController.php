<?php

namespace App\Controller\Admin;

use App\Entity\Horaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class HoraireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Horaire::class;
    }

    public function configureFields(string $pageName): iterable
    {
    yield IdField::new('id')->hideOnForm();
    yield TextField::new('CodeJour');
    yield TextField::new('Jour');
    yield TimeField::new('Matin_Deb');
    yield TimeField::new('Matin_Fin');
    yield TimeField::new('Am_Deb');
    yield TimeField::new('Am_Fin');
  
   /* yield ChoiceField::new('Est_Ferme')->setChoices([
        'Oui' => '1',
        'Non' => '0',
    ]);*/
        
      
    }
    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
