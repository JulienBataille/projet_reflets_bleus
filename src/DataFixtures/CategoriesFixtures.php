<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoriesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = [ // Array of categories to be added to the database. // Tableau des catégories à ajouter à la base de données.
            1 => [
                'name' => 'Piscines',
                'slug' => 'piscines',
                'iconLight' =>'#41aed1',
                'iconDark' => '#0e3f78'
            ],
            2 => [
                'name' => 'Services',
                'slug' => 'services',
                'iconLight' =>'#88c29f',
                'iconDark' => '#41614d'
            ],
            3 => [
                'name' => 'Rénovation',
                'slug' => 'renovation',
                'iconLight' =>'#ecd27e',
                'iconDark' => '#877744'
            ],
            4 => [
                'name' => 'Bien-être',
                'slug' => 'bien-etre',
                'iconLight' =>'#d56c99',
                'iconDark' => '#7d294d'
            ],
            5 => [
                'name' => 'Bâtiment',
                'slug' => 'batiment',
                'iconLight' =>'#afafaf',
                'iconDark' => '#464646'
            ],
            6 => [
                'name' => 'Catalogues',
                'slug' => 'catalogues',
                'iconLight' =>'#41aed1',
                'iconDark' => '#0e3f78'
            ],
            7 => [
                'name' => 'Magasins',
                'slug' => 'magasins',
                'iconLight' =>'#41aed1',
                'iconDark' => '#0e3f78'
            ],
        ];

        
        
        foreach ($categories as $key => $value) {   // Loop to create and persist each category into the database. // Boucle pour créer et persister chaque catégorie dans la base de données.
            $category = new Categories();
            $category->setName($value['name']); // Définir le nom de la catégorie. // Set the name of the category.
            $category->setSlug($value['slug']); // Définir le slug de la catégorie. // Set the slug of the category.
            $category->setIconLight($value['iconLight']); // Définir l'icône de la catégorie. // Set the icon of the category.
            $category->setIconDark($value['iconDark']); // Définir l'icône de la catégorie. // Set the icon of the category.

            $manager->persist($category); // Préparer la catégorie pour l'insertion en base de données. // Prepare the category for database insertion.
        }

        $manager->flush();  // Execute all persistence operations to save the categories in the database. // Exécuter toutes les opérations de persistance pour enregistrer les catégories en base de données.
    }
}
