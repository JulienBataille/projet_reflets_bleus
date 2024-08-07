<?php

namespace App\Controller;

use App\Repository\SliderRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ServicesController extends AbstractController
{
    #[Route('/services', name: 'app_services')]
    public function index(SliderRepository $sliderRepository, CategoriesRepository $categoriesRepository): Response
    {
        $category = $categoriesRepository->findOneBy(['name' => 'Services']);
        $slider = $sliderRepository->findBy(['Category' => $category]);

        return $this->render('services/index.html.twig', [
            'controller_name' => 'ServicesController',
            'title' => 'services',
            'slider' => $slider,
        ]);
    }
}
