<?php

namespace App\DataFixtures;

use App\Entity\Option;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class OptionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $options[] = new Option('titre du blog', 'blog_about', 'Mon Blog', TextType::class);
        $options[] = new Option('Texte du copyright', 'copyright', 'Tous droits réservés', TextType::class);
        $options[] = new Option('Tout le monde peu s\'inscrire', 'users_can_register', true, CheckboxType::class);


        foreach ($options as $option) {

            $manager->persist($option);

        }

        $manager->flush();
    }


}