<?php

namespace App\Form;

use App\Entity\Card;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Card1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user', EntityType::class,[
                'class' => User::class,
                'choice_label'=> 'name',
                'multiple'=>true,
                'expanded'=>true
            ])
           ->add('article', EntityType::class,[
            'class' =>Articles::class,
            'choice_label'=> 'titre',
            'multiple'=>true,
            'expanded'=>true
           ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Card::class,
        ]);
    }
}
