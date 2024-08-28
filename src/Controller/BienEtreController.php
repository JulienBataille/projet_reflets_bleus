<?php

namespace App\Controller;

use App\Repository\SliderRepository;
use App\Repository\CategoriesRepository;
use App\Service\CategoryColorService; // Assurez-vous d'importer le service
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BienEtreController extends AbstractController
{
    private CategoriesRepository $categoriesRepository;
    private SliderRepository $sliderRepository;
    private CategoryColorService $colorService;

    public function __construct(
        CategoriesRepository $categoriesRepository,
        SliderRepository $sliderRepository,
        CategoryColorService $colorService
    ) {
        $this->categoriesRepository = $categoriesRepository;
        $this->sliderRepository = $sliderRepository;
        $this->colorService = $colorService;
    }

    #[Route('/bien-etre', name: 'app_bien_etre')]
    public function index(): Response
    {
        // Récupération de la catégorie 'Bien-être'
        $category = $this->categoriesRepository->findOneBy(['name' => 'Bien-être']);
        
        // Récupération des sliders associés à la catégorie
        $slider = $this->sliderRepository->findBy(['Category' => $category]);

        // Récupération des couleurs associées à la catégorie
        $colors = $this->colorService->getColorsForCategory($category->getName());

        return $this->render('bien_etre/index.html.twig', [
            'title' => 'Bien-être',
            'slider' => $slider,
            'iconLight' => $colors['iconLight'],
            'iconDark' => $colors['iconDark'],
        ]);
    }
}
