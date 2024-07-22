<?php

namespace App\Controller\Admin;

use App\Entity\RapportVeterinaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;


class RapportVeterinaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RapportVeterinaire::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
       yield IdField::new('Id')->hideOnForm();
       yield TextEditorField::new('Commentaire');
       yield TextField::new('Etat');
       yield DateField::new('Datepassage');
       yield AssociationField::new('animal');
    }
    
}
