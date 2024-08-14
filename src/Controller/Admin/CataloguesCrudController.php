<?php

namespace App\Controller\Admin;

use App\Entity\Catalogues;
use Vich\UploaderBundle\Form\Type\VichFileType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CataloguesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Catalogues::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title', 'Titre');

        yield ImageField::new('thumbnailImage', 'Image miniature')
            ->setBasePath('uploads/catalogues/thumbnails')
            ->setUploadDir('public/uploads/catalogues/thumbnails')
            ->setRequired(false);

        yield TextField::new('PDFFile', 'Choisissez le PDF')
            ->setFormType(VichFileType::class)
            ->onlyOnForms();

        yield TextField::new('PDF', 'Nom du PDF')
            ->onlyOnIndex()
            ->formatValue(function ($value) {
                return $value ? sprintf('<a href="/uploads/catalogues/pdf/%s" target="_blank">%s</a>', $value, $value) : 'Aucun PDF';
            });

        yield BooleanField::new('is_visible', 'Visible');
    }
}
