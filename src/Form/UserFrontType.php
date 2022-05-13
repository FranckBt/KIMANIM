<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UserFrontType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => FALSE, 
                'attr' => [
                'placeholder' => 'Votre nom'
                ]
                
            ])
            ->add('surname', TextType::class, [
                'label' => FALSE, 
                'attr' => [
                'placeholder' => 'Votre prénom'
                ]
            ])
            ->add('alias', TextType::class, [
                'label' => FALSE,
                'attr' => [
                'placeholder' => 'Votre pseudo'
                ]
            ])
            ->add('bio', TextareaType::class, [
                'label' => FALSE,
                'required' => FALSE,
                'attr' => [
                    'placeholder' => 'Bio',
                ]
            ])
            ->add('avatar', FileType::class, [
                'label' => 'Avatar',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Seules les images au format .jpeg, .jpg et .png sont acceptées',
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}