<?php

namespace App\Controller\Admin;

use App\Entity\Habitat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Action, Actions, Crud, KeyValueStore};
use Vich\UploaderBundle\Form\Type\VichImageType;


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
      
       yield IdField::new('Id')->hideOnForm();
      
       yield TextField::new('Nom');
       yield TextField::new('Description');
       yield TextEditorField::new('CommentaireHabitat');
       yield Field::new('name', 'Nom du fichier')->hideOnForm();
       yield ImageField::new('image')
            ->setBasePath('/images/habitats')
            ->onlyOnIndex()
            ->hideOnForm()
            ->setUploadDir('public/images/habitat')
            ->setRequired(false);
       yield TextField::new('file')
            ->setFormType(VichImageType::class)
            ->setLabel('Image')
            ->hideOnIndex();
    }
    
}