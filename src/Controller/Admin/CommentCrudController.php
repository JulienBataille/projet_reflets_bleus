<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

            yield IdField::new('id')->onlyOnIndex();
            yield TextField::new('title','Titre')
                ->setColumns(12);
            yield TextareaField::new('content', 'Description')
                ->setColumns(12);
            yield AssociationField::new('Categories', 'Catégorie')
                ->setCrudController(CategoriesCrudController::class)
                ->setColumns(12);

    }
    
}
