<?php

namespace App\DataFixtures;

use App\Entity\Magasins;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MagasinFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $magasins = [ // Array of categories to be added to the database. // Tableau des catégories à ajouter à la base de données.
            1 => [
                'adresse' => '140 route du Lycée Agricole',
                'codepostal' => '40180',
                'city'=>'St Pandelon'
            ],
            2 => [
                'adresse' => '219 rue Pascal Duprat',
                'codepostal' => '40700',
                'city'=>'Hagetmau'
            ],
           
        ];

        
        
        foreach ($magasins as $key => $value) {   // Loop to create and persist each category into the database. // Boucle pour créer et persister chaque catégorie dans la base de données.
            $magasin = new Magasins();
            $magasin->setAdresse($value['adresse']); // Définir le nom de la catégorie. // Set the name of the category.
            $magasin->setCodepostal($value['codepostal']); // Définir le slug de la catégorie. // Set the slug of the category.
            $magasin->setCity($value['city']); // Définir le slug de la catégorie. // Set the slug of the category.
            $manager->persist($magasin); // Préparer la catégorie pour l'insertion en base de données. // Prepare the category for database insertion.
        }

        $manager->flush();  // Execute all persistence operations to save the categories in the database. // Exécuter toutes les opérations de persistance pour enregistrer les catégories en base de données.
    }
}
