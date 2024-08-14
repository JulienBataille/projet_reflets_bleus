<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Ici, vous pouvez créer et configurer vos objets à insérer dans la base de données.
        // For example, you can create and configure your objects to insert into the database.
        
        // Exemple de création d'un produit (commenté pour le moment)
        // $product = new Product();
        // $manager->persist($product); // Prépare l'objet à être inséré dans la base de données.

        $manager->flush(); // Exécute toutes les opérations de persistance.
    }
}
