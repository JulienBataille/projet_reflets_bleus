<?php

namespace App\Controller;

use App\Entity\Option;
use App\Repository\SliderRepository;
use App\Repository\MagasinsRepository;
use App\Repository\CategoriesRepository;
use App\Service\CategoryColorService; // Assurez-vous d'importer le service pour les couleurs
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MagasinsController extends AbstractController
{
    private SliderRepository $sliderRepository;
    private CategoriesRepository $categoriesRepository;
    private MagasinsRepository $magasinsRepository;
    private EntityManagerInterface $em;
    private CategoryColorService $colorService;

    public function __construct(
        SliderRepository $sliderRepository,
        CategoriesRepository $categoriesRepository,
        MagasinsRepository $magasinsRepository,
        EntityManagerInterface $em,
        CategoryColorService $colorService
    ) {
        $this->sliderRepository = $sliderRepository;
        $this->categoriesRepository = $categoriesRepository;
        $this->magasinsRepository = $magasinsRepository;
        $this->em = $em;
        $this->colorService = $colorService;
    }

    #[Route('/magasins', name: 'app_magasins')]
    public function index(): Response
    {
        // Utiliser une catégorie spécifique ou une catégorie par défaut
        $category = $this->categoriesRepository->findOneBy(['name' => 'Magasins']);
        $slider = $this->sliderRepository->findBy(['Category' => $category]);

        // Récupérer les magasins
        $magasinStPandelon = $this->magasinsRepository->findOneBy(['city' => 'St Pandelon']);
        $magasinHagetmau = $this->magasinsRepository->findOneBy(['city' => 'Hagetmau']);

        // Récupérer les options
        $tel = $this->em->getRepository(Option::class)->findOneBy(['name' => 'tel']);
        $mail = $this->em->getRepository(Option::class)->findOneBy(['name' => 'mail']);

        // Utiliser les couleurs pour la catégorie "Magasins" ou des valeurs par défaut
        $colors = $this->colorService->getColorsForCategory($category->getName());


        return $this->render('magasins/index.html.twig', [
            'title' => 'Magasins',
            'slider' => $slider,
            'magasinStPandelon' => $magasinStPandelon,
            'magasinHagetmau' => $magasinHagetmau,
            'tel' => $tel,
            'mail' => $mail,
            'iconLight' => $colors['iconLight'],
            'iconDark' => $colors['iconDark'],
        ]);
    }
}
