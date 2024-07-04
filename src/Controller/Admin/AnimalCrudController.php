<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;


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
        //     ->'label' => 'Brochure (PDF file)',

        // // unmapped means that this field is not associated to any entity property
        // 'mapped' => false,

        // // make it optional so you don't have to re-upload the PDF file
        // // every time you edit the Product details
        // 'required' => false,

        // // unmapped fields can't define their validation using attributes
        // // in the associated entity, so you can use the PHP constraint classes
        // 'constraints' => [
        //     new File([
        //         'maxSize' => '1024k',
        //         'mimeTypes' => [
        //             'application/pdf',
        //             'application/x-pdf',
        //         ],
        //         'mimeTypesMessage' => 'Please upload a valid PDF document',
        //     ])
        // ],
    // ])




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
