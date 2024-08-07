<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\SliderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MagasinsController extends AbstractController
{
    #[Route('/magasins', name: 'app_magasins')]
    public function index(SliderRepository $sliderRepository, CategoriesRepository $categoriesRepository): Response
    {
        $category = $categoriesRepository->findOneBy(['name' => 'Magasins']);

        $slider = $sliderRepository->findBy(['Category' => $category]);
        
        return $this->render('magasins/index.html.twig', [
            'controller_name' => 'ContactController',
            'title'=>'magasins',
            'slider'=>$slider
        ]);
    }
}
