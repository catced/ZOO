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
        yield TextField::new('Prenom');
        yield AssociationField::new('race');
        yield AssociationField::new('habitat');
        yield Field::new('name', 'Nom du fichier')->hideOnForm();
        yield ImageField::new('image')
            ->setBasePath('/images/animals')
            ->onlyOnIndex()
            ->hideOnForm()
            ->setUploadDir('public/images/animal')
            ->setRequired(false);
        yield TextField::new('file')
                    ->setFormType(VichImageType::class)
                    ->setLabel('Image')
                    ->hideOnIndex();
    
       
    }

   
}