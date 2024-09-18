<?php
namespace App\Controller;

use App\Entity\Option;
use App\Repository\SliderRepository;
use App\Service\CategoryColorService;
use App\Repository\MagasinsRepository;
use App\Repository\CataloguesRepository;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    private CategoriesRepository $categoriesRepository;
    private MagasinsRepository $magasinsRepository;
    private CataloguesRepository $cataloguesRepository;
    private SliderRepository $sliderRepository;
    private CategoryColorService $colorService;
    private EntityManagerInterface $em;

    public function __construct(
        CategoriesRepository $categoriesRepository,
        SliderRepository $sliderRepository,
        MagasinsRepository $magasinsRepository,
        CataloguesRepository $cataloguesRepository,
        EntityManagerInterface $em,
        CategoryColorService $colorService
    ) {
        $this->cataloguesRepository = $cataloguesRepository;
        $this->magasinsRepository = $magasinsRepository;
        $this->categoriesRepository = $categoriesRepository;
        $this->sliderRepository = $sliderRepository;
        $this->em = $em;
        $this->colorService = $colorService;
    }

    #[Route('/{slug}', name: 'category_show', requirements: ['slug' => '[a-zA-Z0-9\-]+'])]
    public function show(string $slug): Response
    {
        $category = $this->categoriesRepository->findOneBy(['slug' => $slug]);
    
        // Vérifier si la catégorie existe
        if (!$category) {
            throw $this->createNotFoundException('La catégorie demandée n\'existe pas.');
        }
    
        $catalogues = $this->cataloguesRepository->findBy(['is_visible' => true]);
    
        $magasinStPandelon = $this->magasinsRepository->findOneBy(['city' => 'St Pandelon']);
        $magasinHagetmau = $this->magasinsRepository->findOneBy(['city' => 'Hagetmau']);
    
        $sliders = $this->sliderRepository->findBy(['Category' => $category]);
    
        $colors = $this->colorService->getColorsForCategory($category->getName());
    
        $tel = $this->em->getRepository(Option::class)->findOneBy(['name' => 'tel']);
        $mail = $this->em->getRepository(Option::class)->findOneBy(['name' => 'mail']);
    
        $templatePath = 'category/'.$slug . '.html.twig';
    
        if (!file_exists($this->getParameter('kernel.project_dir') . '/templates/' . $templatePath)) {
            $templatePath = 'bundles\TwigBundle\Exception/error404.html.twig'; // Template par défaut si le template spécifique n'existe pas
        }
    
        return $this->render($templatePath, [
            'title' => $category->getName(),
            'catalogues' => $catalogues,
            'sliders' => $sliders,
            'iconLight' => $colors['iconLight'],
            'iconDark' => $colors['iconDark'],
            'magasinStPandelon' => $magasinStPandelon,
            'magasinHagetmau' => $magasinHagetmau,
            'tel' => $tel,
            'mail' => $mail,
        ]);
    }
    
}
