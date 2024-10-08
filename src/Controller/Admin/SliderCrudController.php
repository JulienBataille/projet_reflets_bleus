<?php

namespace App\Controller\Admin;

use App\Entity\Slider;
use App\Form\Type\MediaType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SliderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string 
    {
        return Slider::class;
    }

    public function configureFields(string $pageName): iterable 
    {
        yield TextField::new('name', 'Nom');

        yield AssociationField::new('Category', 'Catégorie'); 

        yield CollectionField::new('media', 'Médias')
            ->setEntryType(MediaType::class); 
    }
}
