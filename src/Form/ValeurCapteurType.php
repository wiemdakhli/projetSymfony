<?php

namespace App\Form;

use App\Entity\ValeurCapteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ValeurCapteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idValeur',ChoiceType::class,[
                'choices'=>[
                    '20'=>1,
                    '1'=>2
                ],
                'multiple' => false
            ])

            ->add('idCapteur',ChoiceType::class,[
                'choices'=>[
                    'phpCap'=>1,
                    'php2'=>2,
                    'do22'=>10
                ],
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ValeurCapteur::class,
        ]);
    }
}
