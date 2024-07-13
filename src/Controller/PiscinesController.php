<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PiscinesController extends AbstractController
{
    #[Route('/piscines', name: 'app_piscines')]
    public function index(CommentRepository $comment, Request $request,CategoriesRepository $categories): Response
    {
        $categories = $categories->findBy(['name' => 'piscines']);
        return $this->render('piscines/index.html.twig', [
            'controller_name' => 'PiscinesController',
            'title' => 'piscines',
            'comments' => $comment->findAll()

        ]);
    }
}
