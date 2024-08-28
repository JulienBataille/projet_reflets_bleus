<?php

namespace App\Controller;

use App\Entity\Option;
use App\Repository\SliderRepository;
use App\Repository\MagasinsRepository;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MagasinsController extends AbstractController
{
    #[Route('/magasins', name: 'app_magasins')]
    public function index(SliderRepository $sliderRepository, CategoriesRepository $categoriesRepository, MagasinsRepository $magasinsRepository, EntityManagerInterface $em): Response
    {
        $category = $categoriesRepository->findOneBy(['name' => 'Magasins']);
        $slider = $sliderRepository->findBy(['Category' => $category]);
        $magasinStPandelon = $magasinsRepository->findOneBy(['city' => 'St Pandelon']);
        $magasinHagetmau = $magasinsRepository->findOneBy(['city' => 'Hagetmau']);

        $tel = $em->getRepository(Option::class)->findOneBy(['name'=>'tel']);
        $mail = $em->getRepository(Option::class)->findOneBy(['name'=>'mail']);


        
        return $this->render('magasins/index.html.twig', [
            'controller_name' => 'ContactController',
            'title'=>'magasins',
            'slider'=>$slider,
            'magasinStPandelon'=>$magasinStPandelon,
            'magasinHagetmau'=>$magasinHagetmau,
            'tel' => $tel,
            'mail' => $mail,
        ]);
    }
}
