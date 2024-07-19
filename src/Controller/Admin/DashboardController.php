<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Projet Reflets Bleus');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Aller sur le site', 'fa fa-home', 'home');

        if($this->isGranted('ROLE_ADMIN')){


            yield MenuItem::subMenu('Categories', 'fas fa-tags')->setSubItems([
                MenuItem::linkToCrud('Toutes les catégories', 'fas fa-list', Categories::class),
                MenuItem::linkToCrud('Ajoutez', 'fas fa-plus', Categories::class)->setAction(Crud::PAGE_NEW),
            ]);

        yield MenuItem::subMenu('Compte', 'fas fa-user')->setSubItems([
            MenuItem::linkToCrud('Tous les Comptes', 'fas fa-user-friends', User::class),
            MenuItem::linkToCrud('Ajoutez', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
        ]);
    }

    }
}