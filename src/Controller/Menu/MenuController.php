<?php

namespace App\Controller\Menu;



use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    public function index (CategoriesRepository $categories, Request $request) : Response
    {
        return $this->render('_partials/header.html.twig',[
                'categories' => $categories->findAll()
        ]);
    }
}