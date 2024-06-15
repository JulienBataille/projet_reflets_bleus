<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoriesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $category = [
            1 => [
                'name' => 'Accueil',
                'slug'=>'/'
            ],
            2 => [
                'name' => 'Piscines',
                'slug'=>'piscines'
            ],
            3 => [
                'name' => 'Services',
                'slug'=>'services'
            ],
            4 => [
                'name' => 'Rénovation',
                'slug'=>'renovation'
            ],
            5 => [
                'name' => 'Bien-être',
                'slug'=>'bien-etre'
            ],
            6 => [
                'name' => 'Bâtiment',
                'slug'=>'batiment'
            ],
            7 => [
                'name' => 'Catalogues',
                'slug'=>'catalogues'
            ],
        ];
        foreach ($category as $key => $value) {
            $category = new Categories();
            $category->setName($value['name']);
            $category->setSlug($value['slug']);

            $manager->persist($category);
     
        }

        $manager->flush();
    
    }
}
