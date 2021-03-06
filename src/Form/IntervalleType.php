<?php

namespace App\Form;

use App\Entity\Intervalle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class IntervalleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('idintervalle', ChoiceType::class,[
            //    'choices' =>[
            //         'PH'=>'ph',
            //         'DO' =>'do',
            //         'TEMP' =>'temp'
            //     ]
            // ])
            ->add('rangmin')
            ->add('rangmax')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intervalle::class,
        ]);
    }
}
