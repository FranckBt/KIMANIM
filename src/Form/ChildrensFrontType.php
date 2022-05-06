<?php

namespace App\Form;

use App\Entity\Childrens;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChildrensFrontType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $tab = [
            '4-6 ans' => '4-6',
            '6-8 ans' => '6-8',
            '8-12 ans' => '8-12', 
            '12-16 ans' => '12-16'
        ];

        $builder
            ->add('name', TextType::class, [
                'label' => FALSE,
                'attr' => [
                    'placeholder' => 'Prénom ou Surnom',
            ]])
            ->add('age_range', ChoiceType::class, [
                'label' => 'Tranche d\'age',
                'choices' => [
                    'Tranche d\'age' => $tab
                    ]
            ])
            ->add('additional', TextareaType::class, [
                'required' => FALSE,
                'label' => FALSE,
                'attr' => [
                'placeholder' => 'Informations complémentaires',
            ]])
            ;
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Childrens::class,
        ]);
    }
}