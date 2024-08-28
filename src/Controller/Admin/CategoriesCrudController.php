<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categories::class;
    }

    public function configureFields(string $pageName): iterable
    {

        if ($this->isGranted('ROLE_ADMIN')) {
            // Fields specific to admin role
            yield TextField::new('name', 'Nom de la catégorie');
            yield SlugField::new('slug', 'Slug')->setTargetFieldName('name');
        } else {
            // Disable fields for non-admins
            yield TextField::new('name', 'Nom de la catégorie')
                ->setDisabled();
        }
        // Common fields accessible to all users
        yield ColorField::new('iconLight', 'Couleur principale');
        yield ColorField::new('iconDark', 'Couleur secondaire');

    }

    public function configureActions(Actions $actions): Actions
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            $actions = $actions
                ->remove(Crud::PAGE_INDEX, Action::BATCH_DELETE)
                ->remove(Crud::PAGE_INDEX, Action::DELETE)
                ->remove(Crud::PAGE_INDEX, Action::NEW);
        }

        return $actions;
    }

    public function configureCrud(Crud $crud): Crud
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            $crud = $crud
            ->showEntityActionsInlined();
        }

        return $crud;
    }

}
