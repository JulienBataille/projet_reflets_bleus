<?php

namespace App\Controller;

use App\Repository\SliderRepository;
use App\Repository\CategoriesRepository;
use App\Service\CategoryColorService; // Assurez-vous d'importer le service pour les couleurs
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RenovationController extends AbstractController
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

    #[Route('/renovation', name: 'app_renovation')]
    public function index(): Response
    {
        $category = $this->categoriesRepository->findOneBy(['name' => 'Renovation']);
        $slider = $this->sliderRepository->findBy(['Category' => $category]);

        $colors = $this->colorService->getColorsForCategory($category->getName());



        return $this->render('renovation/index.html.twig', [
            'title' => 'Renovation',
            'slider' => $slider,
            'iconLight' => $colors['iconLight'],
            'iconDark' => $colors['iconDark'],
        ]);
    }
}
