<?php

namespace App\Controller\Admin;

use App\Entity\Catalogue;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use PHPUnit\TextUI\XmlConfiguration\File;

class CatalogueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Catalogue::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title','titre'),
            FileField::new('PDF','PDF'),
        ];
    }
    
}
