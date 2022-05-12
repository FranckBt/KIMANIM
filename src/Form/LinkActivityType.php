<?php

namespace App\Form;

use App\Entity\Activities;
use App\Entity\Childrens;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinkActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $userid = $options['iduser'];
        $builder
            ->add('childrens', EntityType::class, [
                'label' => false,
                'multiple' => true,
                'expanded' => true,
                'class' => Childrens::class,
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $er) use ($userid) {
                    return $er->createQueryBuilder('c')
                        ->where('c.parent = :uid') 
                        ->setParameter('uid', $userid)
                        ->orderBy('c.name', 'ASC');
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Activities::class,
            'iduser' => null,
        ]);
    }
}
