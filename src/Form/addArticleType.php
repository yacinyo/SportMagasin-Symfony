<?php

namespace App\Form;

use App\Entity\Articles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Brand;
use App\Entity\Catagory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;






class addArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('titre')
        ->add('prix')
        ->add('prixBarre')
        ->add('nouveau')
        ->add('description')
    
        ->add('enregister',submitType::class)
        ->add('brand', EntityType::class,[
            'class'=> Brand::class,
            'choice_label'=> 'name',
        ])
            ->add('category', EntityType::class,[
                'class' => Catagory::class,
                'choice_label'=> 'name',
                'multiple'=>true,
                'expanded'=>true
            ])

            ->add('image', FileType::class, [
                'label' => 'Image',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => ['image/png', 'image/jpeg'],
                        'mimeTypesMessage' => 'veuillez mettre un visuel',
                    ])
                ],
            ])

            
        ;
      
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
