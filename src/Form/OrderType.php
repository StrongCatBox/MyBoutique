<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Carrier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {



        $builder
            ->add('addresses', EntityType::class, [
                'class' => Address::class,
                'label' => 'Choisissez un adresse',
                /* 'choice_label' => function (Address $address) {
                    return $address->getName() . ' ' . $address->getAddress();
                },*/
                'choices' => $options['user']->getAddresses(),
                'multiple' => false,
                'expanded' => true,
                'required' => true
            ])

            ->add('transporteurs', EntityType::class, [
                'class' => Carrier::class,
                'label' => 'Choisissez un transporteur',
                /* 'choice_label' => function (Carrier $carrier) {
                    return $carrier->getName() . ' ' . $carrier->getPrice();
                },*/
                //'choices' => $options['user']->getPrice(),
                'multiple' => false,
                'expanded' => true,
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'user' => null
        ]);
    }
}
