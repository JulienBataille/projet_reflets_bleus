<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RenovationController extends AbstractController
{
    #[Route('/renovation', name: 'app_renovation')]
    public function index(): Response
    {
        return $this->render('renovation/index.html.twig', [
            'controller_name' => 'RenovationController',
        ]);
    }
}
