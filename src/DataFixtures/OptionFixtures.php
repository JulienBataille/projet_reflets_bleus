<?php

namespace App\DataFixtures;

use App\Entity\Option;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    { 
        $options = [    // Creation of an array of options to be added to the database. // Création d'un tableau d'options à ajouter à la base de données.
            new Option('titre du blog', 'blog_about', 'Mon Blog', TextType::class),  // Option pour le titre du blog
            new Option('Texte du copyright', 'copyright', 'Tous droits réservés', TextType::class), // Option pour le texte de copyright
            new Option('Tout le monde peut s\'inscrire', 'users_can_register', '0', CheckboxType::class) // Option pour autoriser l'inscription
        ];
        
        foreach ($options as $option) { // Loop to persist each option into the database. // Boucle pour persister chaque option dans la base de données.
            $manager->persist($option); // Préparer l'objet Option pour l'insertion en base de données.
        }
        
        $manager->flush();  // Execute all persistence operations to save the options in the database. // Exécuter toutes les opérations de persistance pour enregistrer les options en base de données.
    }
}
