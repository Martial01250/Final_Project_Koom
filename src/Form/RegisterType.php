<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Entrez votre Email'
                ],
                'constraints' => [
                    new Email(),
                ],
            ])

            ->add('password', RepeatedType::class, [
                'label' => 'Password',
                'type' => PasswordType::class,
                'invalid_message' => 'Les mot de passe ne correspondent pas',
                'required' => true,

                'first_options'  => [
                    'label' => 'Mot de passe',
                    'hash_property_path' => 'password',
                    'attr' => [
                        'placeholder' => 'Entrez votre mot de passe'
                    ],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Entrez votre mot de passe',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Votre mot se passe doit contenir min {{ limit }} characters',
                            'max' => 50,
                        ]),
                        new Regex([
                            'message' => 'Le mot de passe doit comprendre au moins 6 caractères, des lettres en majuscules et en minuscules, des chiffres et des caractères spéciaux',
                            'pattern' => '/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{6,}$/',
                        ])
                    ],
                ],

                'second_options' => [
                    'label' => 'Confirmation mot de passe',
                    'attr' => ['placeholder' => 'Confirmation de votre Mot de passe'],
                ],

                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
