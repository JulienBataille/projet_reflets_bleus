<?php

namespace App\Controller\Admin;

use App\Entity\Magasins;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MagasinsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Magasins::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('city', 'Ville');
        yield TextField::new('adresse', 'Adresse');
        yield TextField::new('codepostal', 'Code postale');

    }
    
}
