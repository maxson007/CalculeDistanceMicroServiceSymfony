<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalculateDistanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ipAddress', null, array('attr'=>array('placeholder'=>'112.23.122.21'),))
            ->add('postalAdress',null,array(
                'attr'=>array('placeholder'=>'112 Rue Cortot, 75018 Paris France'),
                'help' => 'The Postal address format: 112 Rue Cortot, 75018 Paris France ',
            ) )
            ->add('save', SubmitType::class, ['label' => 'Calcule'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CalculateDistanceDTO::class
        ]);
    }
}
