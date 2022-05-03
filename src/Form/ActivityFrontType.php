<?php

namespace App\Form;

use App\Entity\Activities;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivityFrontType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $tab = [];
        for($i = 1; $i <= 10; $i++){
            $tab[$i] = "$i";
        }

        $builder
            ->add('title', TextType::class, [])
            ->add('start_on', DateTimeType::class, [
                'date_widget' => 'single_text',
                'input' => 'datetime_immutable'
            ])
            ->add('adress', TextareaType::class, [])
            ->add('city', TextType::class, [])
            ->add('zipcode', TextType::class, [])
            ->add('description', TextareaType::class, [])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Brouillon' => 'Brouillon',
                    'Publier' => 'Publier',
                ]
            ])
            // ajout d'une liste nombres 1 => 10
            ->add('minParticipants', ChoiceType::class, [
                'choices' => $tab
            ])
            ;
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activities::class,
        ]);
    }
}