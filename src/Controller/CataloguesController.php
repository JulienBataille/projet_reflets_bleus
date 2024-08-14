<?php

namespace App\Controller;

use App\Repository\CataloguesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CataloguesController extends AbstractController
{
    #[Route('/catalogues', name: 'app_catalogues')]
    public function index(CataloguesRepository $cataloguesRepository): Response
    {
        $catalogues = $cataloguesRepository->findBy(['is_visible' => true]);
        return $this->render('catalogues/index.html.twig', [
            'controller_name' => 'CataloguesController',
            'title'=>'catalogues',
            'catalogues' => $catalogues,
        ]);
    }
}
