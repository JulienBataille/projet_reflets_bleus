<?php

namespace App\Controller;

use App\Entity\Slider;
use App\Repository\SliderRepository;
use App\Repository\CommentRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PiscinesController extends AbstractController
{
    #[Route('/piscines', name: 'app_piscines')]
    public function index(SliderRepository $sliderRepository, CategoriesRepository $categoriesRepository): Response
    {
        $category = $categoriesRepository->findOneBy(['name' => 'Piscines']);
        $slider = $sliderRepository->findBy(['Category' => $category]);

        return $this->render('piscines/index.html.twig', [
            'controller_name' => 'PiscinesController',
            'title' => 'piscines',
            'slider' => $slider

        ]);
        
    }

}
