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
                'name' => 'Piscines',
                'slug'=>'piscines'
            ],
            2 => [
                'name' => 'Services',
                'slug'=>'services'
            ],
            3 => [
                'name' => 'Rénovation',
                'slug'=>'renovation'
            ],
            4 => [
                'name' => 'Bien-être',
                'slug'=>'bien-etre'
            ],
            5 => [
                'name' => 'Bâtiment',
                'slug'=>'batiment'
            ],
            6 => [
                'name' => 'Catalogues',
                'slug'=>'catalogues'
            ],
            6 => [
                'name' => 'Magasins',
                'slug'=>'magasins'
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
