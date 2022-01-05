<?php

namespace App\Form;

use App\Entity\Comand;
use App\Entity\Country;
use App\Entity\Pilot;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PilotFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('surname')
            ->add('comand', EntityType::class, [
                'class'=>Comand::class
            ])
            ->add('country', EntityType::class, [
                'class'=>Country::class,
//                'choice_label'=>'country'
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pilot::class,
        ]);
    }
}
