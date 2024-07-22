<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MenuItem;


class AnimalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Animal::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('Id')->hideOnForm();
        yield TextField::new('Code_Puce');
        yield TextField::new('Prenom');
        yield AssociationField::new('race');
        yield AssociationField::new('habitat');

        // yield Field::new('image')
        //             ->setFormType(VichImageType::class)
        //             ->onlyOnForms();
        // yield ImageField::new('imageName')
        //             ->setBasePath('/images/animals')
        //             ->onlyOnIndex();
    
        yield CollectionField::new('image')
            -> setBasePath('C:\Users\Moi\Downloads')
            -> setUploadDir('public\images\animal')
            -> label => 'Images seulement'
    }

   
}