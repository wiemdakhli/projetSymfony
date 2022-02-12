<?php

namespace App\Form;

use App\Entity\Capteur;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Intervalle;


class CapteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('seuilmin')
            ->add('seuilmax')
            ->add('ref', EntityType::class,[
                'class' => Intervalle::class,
                'choice_label' => 'id_intervalle'
            ])
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Capteur::class,
        ]);
    }
}
