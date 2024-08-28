<?php

namespace App\Controller;

use App\Repository\SliderRepository;
use App\Repository\CategoriesRepository;
use App\Service\CategoryColorService; // Assurez-vous d'importer le service
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServicesController extends AbstractController
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

    #[Route('/services', name: 'app_services')]
    public function index(): Response
    {
        // Récupération de la catégorie 'Services'
        $category = $this->categoriesRepository->findOneBy(['name' => 'Services']);
        

        $slider = $this->sliderRepository->findBy(['Category' => $category]);

        // Récupération des couleurs associées à la catégorie
        $colors = $this->colorService->getColorsForCategory($category->getName());

        return $this->render('services/index.html.twig', [
            'title' => 'Services',
            'slider' => $slider,
            'iconLight' => $colors['iconLight'],
            'iconDark' => $colors['iconDark'],
        ]);
    }
}
