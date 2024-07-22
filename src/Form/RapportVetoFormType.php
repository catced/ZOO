<?php

namespace App\Form;


use App\Entity\Animal;
use App\Entity\Nourriture;
use App\Entity\RapportVeto;
use App\Entity\TypeNourriture;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportVetoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('animal', EntityType::class, [
            //     'class' => Animal::class,
            //     'choice_label' => 'nom',
            // ])
            // ->add('type', EntityType::class, [
            //     'class' => Nourriture::class,
            //     'label' => 'nom',
            // ])
            // ->add('etat', TextType::class)
            // ->add('grammage', NumberType::class)
            // ->add('datePassage', DateType::class, [
            //     'widget' => 'single_text',
            // ])
            // ->add('detailEtatAnimal', TextareaType::class);
            ->add('animal', EntityType::class, [
                'class' => Animal::class,
                'choice_label' => 'prenom', 
                'label' => 'Prénom'
            ])
           
            ->add('datepassage', DateType::class, [
                'label' => 'Date de passage'
            ])
            // ->add('type', TextType::class, [
            //     'label' => 'Nourriture'
            // ]) 
            ->add('type', EntityType::class, [
                'class' => TypeNourriture::class,
                'choice_label' => 'libelle',
                'label' => 'Nourriture proposée',
            ])
            ->add('grammage', TextType::class, [
                'label' => 'Quantité'
            ]) 
            ->add('etat', TextType::class, [
                'label' => 'Etat'
            ])
            ->add('detailEtatAnimal', TextareaType::class , [
                'label' => 'Détail de l\'état de l\'animal'
            ])
                     
            // ->add('nourriture', EntityType::class, [
            //     'class' => Nourriture::class,
            //     'choice_label' => 'type',
            //     'label' => ''
            // ]);
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RapportVeto::class,
        ]);
    }
}
