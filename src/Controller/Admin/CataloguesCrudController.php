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

        // Champ pour afficher l'image miniature
        yield ImageField::new('thumbnailImage', 'Image miniature')
            ->setBasePath('uploads/catalogues/thumbnails')  // Chemin où les images sont accessibles
            ->setUploadDir('public/uploads/catalogues/thumbnails')  // Chemin d'upload
            ->setRequired(false); // Optionnel

        // Champ pour télécharger le fichier PDF
        yield TextField::new('PDFFile', 'Choisissez le PDF')
            ->setFormType(VichFileType::class)
            ->onlyOnForms();

        // Champ pour afficher le nom du fichier PDF dans la liste
        yield TextField::new('PDF', 'Nom du PDF')
            ->onlyOnIndex()
            ->formatValue(function ($value) {
                return $value ? sprintf('<a href="/uploads/catalogues/pdf/%s" target="_blank">%s</a>', $value, $value) : 'Aucun PDF';
            });

        // Champ pour afficher et modifier la visibilité
        yield BooleanField::new('is_visible', 'Visible');
    }
}
