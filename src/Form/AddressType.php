<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['required' => false, 'label' => false, 'attr' => ['placeHolder' => 'Nommer votre adresse']])
            ->add('firstName', TextType::class, ['required' => false, 'label' => false, 'attr' => ['placeHolder' => 'Entrer votre prenom']])
            ->add('lastName', TextType::class, ['required' => false, 'label' => false, 'attr' => ['placeHolder' => 'Entrer votre nom']])
            ->add('company', TextType::class, ['required' => false, 'label' => false, 'attr' => ['placeHolder' => 'Entrer votre societe']])
            ->add('address', TextType::class, ['required' => false, 'label' => false, 'attr' => ['placeHolder' => 'Entrer votre adresse']])
            ->add('postal', TextType::class, ['required' => false, 'label' => false, 'attr' => ['placeHolder' => 'Entrer votre code postal']])
            ->add('city', TextType::class, ['required' => false, 'label' => false, 'attr' => ['placeHolder' => 'Entrer votre ville']])
            ->add('country', CountryType::class, ['required' => false, 'label' => false, 'attr' => ['placeHolder' => 'Choisisez votre pays']])
            ->add('phone', TextType::class, ['required' => false, 'label' => false, 'attr' => ['placeHolder' => 'Entrer votre numero de telephone']])
            ->add('submit', SubmitType::class, ['label' => 'Sauvegarder l\'adresse', 'attr' => ['class' => 'btn btn-success col-12']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
