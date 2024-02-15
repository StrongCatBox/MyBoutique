<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, ['required' => false])
            // ->add('roles')
            ->add('lastName', TextType::class, ['required' => false, 'label' => false, 'attr' => ['placeholder' => 'Entrer le prenom']])
            ->add('firstName', TextType::class, ['required' => false, 'label' => false, 'attr' => ['placeholder' => 'Entrer votre nom']])
            ->add('password', PasswordType::class, ['required' => false, 'label' => false, 'attr' => ['placeholder' => 'Entrer le mot de passe']])
            ->add('confirmPassword', PasswordType::class, ['required' => false])
            ->add('submit', SubmitType::class, ['label' => 'S\'inscrire', 'attr' => ['class' => 'btn btn-success col-12']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
