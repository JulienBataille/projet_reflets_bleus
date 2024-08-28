<?php

namespace App\Controller;

use App\Repository\SliderRepository;
use App\Repository\CategoriesRepository;
use App\Service\CategoryColorService; // Assurez-vous d'importer le service pour les couleurs
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PiscinesController extends AbstractController
{
    private SliderRepository $sliderRepository;
    private CategoriesRepository $categoriesRepository;
    private CategoryColorService $colorService;

    public function __construct(
        SliderRepository $sliderRepository,
        CategoriesRepository $categoriesRepository,
        CategoryColorService $colorService
    ) {
        $this->sliderRepository = $sliderRepository;
        $this->categoriesRepository = $categoriesRepository;
        $this->colorService = $colorService;
    }

    #[Route('/piscines', name: 'app_piscines')]
    public function index(): Response
    {
        $category = $this->categoriesRepository->findOneBy(['name' => 'Piscines']);
        $slider = $this->sliderRepository->findBy(['Category' => $category]);


        $colors = $this->colorService->getColorsForCategory($category->getName());


        return $this->render('piscines/index.html.twig', [
            'title' => 'Piscines',
            'slider' => $slider,
            'iconLight' => $colors['iconLight'],
            'iconDark' => $colors['iconDark'],
        ]);
    }
}
