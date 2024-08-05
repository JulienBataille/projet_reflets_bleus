<?php

namespace App\Controller\Admin;

use App\Entity\Subscriber;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;

use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SubscriberCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Subscriber::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

            yield TextField::new('email');
            yield BooleanField::new('is_valid','Inscris à la newsletter');


    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::EDIT);

    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
;
    }
    
}
