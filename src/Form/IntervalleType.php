<?php

namespace App\Form;

use App\Entity\Intervalle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
;


class IntervalleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idIntervalle', TextType::class,[
                'label' => 'Intervalle',
                'attr' =>[
                    'style'=>'border:1px solid black;'
                ]
            ])
            ->add('rangmin',null,[
                'label'=>'rang minimal',
                'attr' =>[
                    'style'=>'border:1px solid black;'
                ]
            
            ])
            ->add('rangmax',null,[
                'label'=>'rang maximal',
                'attr' =>[
                    'style'=>'border:1px solid black;'
                ]
            
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intervalle::class,
        ]);
    }
}
