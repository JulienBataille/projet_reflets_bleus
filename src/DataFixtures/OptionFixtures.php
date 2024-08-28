<?php

namespace App\DataFixtures;

use App\Entity\Option;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class OptionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    { 
        $options = [    // Creation of an array of options to be added to the database. // Création d'un tableau d'options à ajouter à la base de données.
            new Option('Adresse Mail', 'mail', 'contact@refletsbleus.fr', TextType::class), // Option pour le texte de copyright
            new Option('Numéro Magasin', 'tel', '05 58 98 73 96', TelType::class), // Option pour le texte de copyright

        ];
        
        foreach ($options as $option) { // Loop to persist each option into the database. // Boucle pour persister chaque option dans la base de données.
            $manager->persist($option); // Préparer l'objet Option pour l'insertion en base de données.
        }
        
        $manager->flush();  // Execute all persistence operations to save the options in the database. // Exécuter toutes les opérations de persistance pour enregistrer les options en base de données.
    }
}
