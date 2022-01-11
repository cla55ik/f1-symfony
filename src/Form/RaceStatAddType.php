<?php

namespace App\Form;

use App\Entity\Pilot;
use App\Entity\Race;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RaceStatAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//            ->add('race', EntityType::class, [
//                'class' => Race::class
//            ])
            ->add(1, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(2, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(3, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(4, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(5, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(6, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(7, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(8, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(9, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(10, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(11, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(12, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(13, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(14, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(15, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(16, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(17, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(18, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(19, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add(20, EntityType::class, [
                'class' => Pilot::class
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
