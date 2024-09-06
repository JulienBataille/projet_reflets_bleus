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
        $options = [    
            new Option('Adresse Mail', 'mail', 'contact@refletsbleus.fr', TextType::class), 
            new Option('Numéro Magasin', 'tel', '05 58 98 73 96', TelType::class), 

        ];
        
        foreach ($options as $option) { 
            $manager->persist($option); 
        }
        
        $manager->flush();  
    }
}
