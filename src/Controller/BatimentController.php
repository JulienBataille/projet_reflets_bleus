<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Repository\SliderRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BatimentController extends AbstractController
{
    #[Route('/batiment', name: 'app_batiment')]
    public function index(SliderRepository $sliderRepository, CategoriesRepository $categoriesRepository): Response
    {
        $category = $categoriesRepository->findOneBy(['name' => 'Batiment'])->getSliders();
        // dd($category);
        $slider = $sliderRepository->findBy(['Category' => $category]);
        
        return $this->render('batiment/index.html.twig', [
            'title'=>'batiment',
            'sliders'=>$category
        ]);
    }
}



