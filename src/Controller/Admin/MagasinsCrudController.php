<?php

namespace App\Controller\Admin;

use App\Entity\Magasins;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
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
