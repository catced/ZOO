<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class HoraireSemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $daysOfWeek = [
            'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'
        ];

        foreach ($daysOfWeek as $day) {
            $builder
                ->add($day.'matin_deb', TimeType::class, [
                    'required' => false,
                    'label' => 'Matin Début',
                ])
                ->add($day.'matin_fin', TimeType::class, [
                    'required' => false,
                    'label' => 'Matin Fin',
                ])
                ->add($day.'am_deb', TimeType::class, [
                    'required' => false,
                    'label' => 'Après-midi Début',
                ])
                ->add($day.'am_fin', TimeType::class, [
                    'required' => false,
                    'label' => 'Après-midi Fin',
                ]);
        }

        $builder->add('save', SubmitType::class, [
            'label' => 'Enregistrer Horaires',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
