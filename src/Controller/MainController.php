<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(CategoriesRepository $categories): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'MainController',
            'categories' => $categories->findAll(),
            'title'=>'home'
        ]);
    }
}
