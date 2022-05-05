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
            ->add('start_on', DateTimeType::class, [
            'date_widget' => 'single_text',
            'input' => 'datetime_immutable'
        ])
            ->add('title', TextType::class, ['attr' => [
                'placeholder' => 'Nom activité',
            ]])
            
            ->add('adress', TextareaType::class, ['attr' => [
                'placeholder' => 'Adresse',
            ]])
            ->add('city', TextType::class, ['attr' => [
                'placeholder' => 'Ville',
            ]])
            ->add('zipcode', TextType::class, ['attr' => [
                'placeholder' => 'Code Postal',
            ]])
            ->add('description', TextareaType::class, ['attr' => [
                'placeholder' => 'Description activité',
            ]])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Statut Activité' => [
                    'Projet' => 'projet',
                    'Mettre en ligne' => 'en ligne',
                ]]
            ])
            // ajout d'une liste nombres 1 => 10
            ->add('minParticipants', ChoiceType::class, [
                'choices' => [
                    'Min Participants' => $tab]
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