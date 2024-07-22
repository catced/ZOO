<?php

namespace App\Controller\Admin;

use App\Entity\Horaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use EasyCorp\Bundle\EasyAdminBundle\Field\CheckboxField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;



class HoraireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Horaire::class;
    }

   public function configureFields(string $pageName): iterable
   
    {
       
        yield ChoiceField::new('jour')->setChoices([
            'Lundi' => 'Lundi',
            'Mardi' => 'Mardi',
            'Mercredi' => 'Mercredi',
            'Jeudi' => 'Jeudi',
            'Vendredi' => 'Vendredi',
            'Samedi' => 'Samedi',
            'Dimanche' => 'Dimanche',
        ]);
    
        yield TimeField::new('Matin_Deb')-> setRequired(false);
        yield TimeField::new('Matin_Fin')->setRequired(false);
        yield TimeField::new('Am_Deb')->setRequired(false);
        yield TimeField::new('Am_Fin')->setRequired(false);
    } 
  
    
   
}