<?php

namespace App\Controller;

use App\Repository\CataloguesRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\CategoryColorService; // Importez le service pour les couleurs

class CataloguesController extends AbstractController
{
    private CataloguesRepository $cataloguesRepository;
    private CategoriesRepository $categoriesRepository;
    private CategoryColorService $colorService;

    public function __construct(
        CategoriesRepository $categoriesRepository,
        CataloguesRepository $cataloguesRepository,
        CategoryColorService $colorService
    ) {
        $this->cataloguesRepository = $cataloguesRepository;
        $this->colorService = $colorService;
        $this->categoriesRepository = $categoriesRepository;

    }

    #[Route('/catalogues', name: 'app_catalogues')]
    public function index(): Response
    {
        // Récupération des catalogues visibles
        $category = $this->categoriesRepository->findOneBy(['name' => 'Catalogues']);
        $catalogues = $this->cataloguesRepository->findBy(['is_visible' => true]);

        // Utiliser une catégorie par défaut ou une valeur de couleur par défaut
        // Assurez-vous d'avoir une catégorie par défaut ou de gérer cela dans le service
        $colors = $this->colorService->getColorsForCategory($category->getName());


        return $this->render('catalogues/index.html.twig', [
            'title' => 'Catalogues',
            'catalogues' => $catalogues,
            'iconLight' => $colors['iconLight'],
            'iconDark' => $colors['iconDark'],
        ]);
    }
}
