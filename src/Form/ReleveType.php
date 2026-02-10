<?php

namespace App\Form;

use App\Entity\Binome;
use App\Entity\Releve;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date du relevé'
            ])
            ->add('pH4', NumberType::class, [
                'label' => 'pH (Acidité)',
                'scale' => 1,
                'html5' => true,
                'attr' => ['step' => '0.1', 'min' => '0', 'max' => '14']
            ])
            ->add('temperature', NumberType::class, [
                'label' => 'Température',
                'scale' => 1,
                'html5' => true,
                'attr' => ['step' => '0.1']
            ])
            ->add('CO2dissous', NumberType::class, [
                'label' => 'CO2 Dissous',
                'scale' => 2,
                'html5' => true,
                'attr' => ['step' => '0.01']
            ])
            ->add('gH', NumberType::class, [
                'label' => 'gH',
                'scale' => 2,
                'html5' => true,
                'attr' => ['step' => '0.01']
            ])
            ->add('kH', NumberType::class, [
                'label' => 'kH',
                'scale' => 2,
                'html5' => true,
                'attr' => ['step' => '0.01']
            ])
            ->add('chlore', NumberType::class, [
                'label' => 'Chlore',
                'scale' => 2,
                'html5' => true,
                'attr' => ['step' => '0.01']
            ])
            ->add('nitrite', NumberType::class, [
                'label' => 'Nitrite',
                'scale' => 2,
                'html5' => true,
                'attr' => ['step' => '0.01']
            ])
            ->add('nitrate', NumberType::class, [
                'label' => 'Nitrate',
                'scale' => 2,
                'html5' => true,
                'attr' => ['step' => '0.01']
            ])
            ->add('binome', EntityType::class, [
                'class' => Binome::class,
                'choice_label' => function (Binome $binome) {
                    return $binome->__toString();
                },
                'label' => 'Binôme',
                'placeholder' => 'Choisir un binôme',
            ])
            ->add('remarque', TextareaType::class, [
                'required' => false,
                'label' => 'Remarques (optionnel)'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Releve::class,
        ]);
    }
}
