<?php

namespace App\Controller;

use App\Repository\SliderRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BienEtreController extends AbstractController
{
    #[Route('/bien-etre', name: 'app_bien_etre')]
    public function index(SliderRepository $sliderRepository, CategoriesRepository $categoriesRepository): Response
    {
        $category = $categoriesRepository->findOneBy(['name' => 'Bien-être']);
        $slider = $sliderRepository->findBy(['Category' => $category]);
        
        return $this->render('bien_etre/index.html.twig', [
            'controller_name' => 'BienEtreController',
            'title'=> 'bien-etre',
            'slider'=>$slider
            
        ]);
    }
}
