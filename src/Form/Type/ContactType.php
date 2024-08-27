<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'label' => 'Nom',
            'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre nom',
                    ])
                ],
            'attr' => [
                'placeholder' => 'Entrez votre nom',
                'class' => 'common-input'
            ]
        ])
        ->add('prenom', TextType::class, [
            'label' => 'Prénom',
            'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre prénom',
                    ])
                ],
            'attr' => [
                    'placeholder' => 'Entrez votre prénom',
                    'class' => 'common-input'
                ]        

        ])
        ->add('tel', TelType::class,[
            'label' =>'Numéro de téléphone',
            'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre téléphone',
                    ])
                ],
            'attr' => [
                    'placeholder' => 'Entrez votre numéro de téléphone',
                    'class' => 'common-input'
                ]
        ])
        ->add('email', EmailType::class,[
            'label' =>'adresse mail',
            'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre email',
                    ])
                ],
            'attr' => [
                    'placeholder' => 'Entrez votre email',
                    'class' => 'common-input'
                ]
        ])
        ->add('subject', TextType::class, [
            'label' => 'Objet de votre demande',
            'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez le sujet de votre demande',
                    ])
                ],
            'attr' => [
                    'placeholder' => 'Entrez le sujet de votre demande',
                    'class' => 'common-input'
                ]
        ])
        ->add('body', TextareaType::class, [
            'label' => 'Message',
            'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre message',
                    ])
                ],
            'attr' => [
                    'placeholder' => 'Entrez votre message',
                    'class' => 'common-input'
                ]

        ])
        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'label' => 'J\'accepte que mes données personnelles soient utilisées pour traiter ma demande selon la politique de confidentialité.',
            'attr' => [
                'class' => 'form-check-input'
            ],

        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Envoyer',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,

        ]);
    }
}
