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
            'label' => 'Date & Heure de l\'activité',
            'date_widget' => 'single_text',
            'input' => 'datetime_immutable'
        ])
            ->add('title', TextType::class, [
                'label' => FALSE,
                'attr' => [
                    'placeholder' => 'Nom activité',
            ]])
            
            ->add('adress', TextareaType::class, [
                'label' => FALSE,
                'attr' => [
                'placeholder' => 'Adresse',
            ]])
            ->add('city', TextType::class, [
                'label' => FALSE,
                'attr' => [
                'placeholder' => 'Ville',
            ]])
            ->add('zipcode', TextType::class, [
                'label' => FALSE,
                'attr' => [
                'placeholder' => 'Code Postal',
            ]])
            ->add('description', TextareaType::class, [
                'label' => FALSE,
                'attr' => [
                'placeholder' => 'Description activité',
            ]])
            ->add('status', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'Statut Activité' => [
                    'Projet' => 'projet',
                    'Mettre en ligne' => 'en ligne',
                ]]
            ])
            // ajout d'une liste nombres 1 => 10
            ->add('minParticipants', ChoiceType::class, [
                'label' => 'Minimum de participants',
                'choices' => [
                    'Min. Participants' => $tab]
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