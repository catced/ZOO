<?php

namespace App\Form;

use App\Entity\Horaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class HoraireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Jour', ChoiceType::class, [
                'choices' => [
                    'Lundi' => 'Lundi',
                    'Mardi' => 'Mardi',
                    'Mercredi' => 'Mercredi',
                    'Jeudi' => 'Jeudi',
                    'Vendredi' => 'Vendredi',
                    'Samedi' => 'Samedi',
                    'Dimanche' => 'Dimanche',
                ],
            ])
            // ->add('Matin_Deb', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('Matin_Fin', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('Am_Deb', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('Am_Fin', null, [
            //     'widget' => 'single_text',
            // ])
            ->add('Matin_Deb', TimeType::class, ['required' => false])
            ->add('Matin_Fin', TimeType::class, ['required' => false])
            ->add('Am_Deb', TimeType::class, ['required' => false])
            ->add('Am_Fin', TimeType::class, ['required' => false]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Horaire::class,
        ]);
    }
}
