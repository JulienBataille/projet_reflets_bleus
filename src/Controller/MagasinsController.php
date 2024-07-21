<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MagasinsController extends AbstractController
{
    #[Route('/magasins', name: 'app_magasins')]
    public function index(): Response
    {
        return $this->render('magasins/index.html.twig', [
            'controller_name' => 'ContactController',
            'title'=>'magasins'
        ]);
    }
}
