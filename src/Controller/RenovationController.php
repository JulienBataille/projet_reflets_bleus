<?php

namespace App\Controller;

use App\Repository\SliderRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RenovationController extends AbstractController
{
    #[Route('/renovation', name: 'app_renovation')]
    public function index(SliderRepository $sliderRepository, CategoriesRepository $categoriesRepository): Response
    {
        $category = $categoriesRepository->findOneBy(['name' => 'Renovation']);
        $slider = $sliderRepository->findBy(['Category' => $category]);
        return $this->render('renovation/index.html.twig', [
            'controller_name' => 'RenovationController',
            'title' => 'renovation',
            'slider' => $slider,
        ]);
    }
}
