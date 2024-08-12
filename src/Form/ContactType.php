<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Nom', TextType::class, [
            'label' => 'Nom',
            'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre nom',
                    ])
                ],
        ])
        ->add('Prenom', TextType::class, [
            'label' => 'Prénom',
            'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre prénom',
                    ])
                ],
                    

        ])
        ->add('Tel', TelType::class,[
            'label' =>'Numéro de téléphone',
            'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre téléphone',
                    ])
                ],
        ])
        ->add('Email', EmailType::class,[
            'label' =>'adresse mail',
            'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre email',
                    ])
                ],
        ])
        ->add('Object', TextType::class, [
            'label' => 'Objet de votre demande',
            'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre objet de votre demande',
                    ])
                ],

        ])
        ->add('Body', TextareaType::class, [
            'label' => 'Message',
            'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez votre message',
                    ])
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
