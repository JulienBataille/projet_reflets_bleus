<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PiscinesController extends AbstractController
{
    #[Route('/piscines', name: 'app_piscines')]
    public function index(): Response
    {
        return $this->render('piscines/index.html.twig', [
            'controller_name' => 'PiscinesController',
        ]);
    }
}
