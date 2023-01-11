<?php

namespace App\Form;


use App\Entity\Message;
use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('recipient', EntityType::class, [
                "class" => User::class,
                "choice_label" => "email",
                'label' => 'destinataire',
                'attr' =>[
                    'style'=>'border:2px solid black;'
                ]
            ])
            ->add('objet',null,[
                'label' => 'objet',
                'attr' =>[
                    'style'=>'border:2px solid black;'
                ]
            ])
            ->add('message', TextareaType::class,[
                'attr' =>[
                    'style'=>'border:2px solid black;'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
