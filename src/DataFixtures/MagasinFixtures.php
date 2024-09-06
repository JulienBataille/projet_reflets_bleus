<?php

namespace App\DataFixtures;

use App\Entity\Magasins;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class MagasinFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $magasins = [
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

        
        
        foreach ($magasins as $key => $value) {   
            $magasin = new Magasins();
            $magasin->setAdresse($value['adresse']); 
            $magasin->setCodepostal($value['codepostal']); 
            $magasin->setCity($value['city']); 
            $manager->persist($magasin); 
        }

        $manager->flush(); 
    }
}
