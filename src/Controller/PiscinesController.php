<?php

namespace App\Controller;

use App\Entity\Slider;
use App\Repository\SliderRepository;
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
        // Retrieves the category entity with the name 'Piscines'. // Récupère l'entité de catégorie avec le nom 'Piscines'.
        $category = $categoriesRepository->findOneBy(['name' => 'Piscines']);
        
        // Finds all sliders associated with the 'Piscines' category. // Trouve tous les sliders associés à la catégorie 'Piscines'.
        $slider = $sliderRepository->findBy(['Category' => $category]);
        // Renders the 'piscines/index.html.twig' template with the retrieved sliders. // Rend le template 'piscines/index.html.twig' avec les sliders récupérés.
        return $this->render('piscines/index.html.twig', [
            'controller_name' => 'PiscinesController', // Name of the controller. // Nom du contrôleur.
            'title' => 'piscines', // Title of the page. // Titre de la page.
            'slider' => $slider // Slider data to be passed to the template. // Données des sliders à passer au template.
        ]);
    }
}
