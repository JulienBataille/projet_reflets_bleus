<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Media;
use App\Entity\Option;
use App\Entity\Slider;
use App\Entity\Magasins;
use App\Entity\Catalogues;
use App\Entity\Categories;
use App\Entity\Subscriber;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin_854763', name: 'admin')]
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

        if ($this->isGranted('ROLE_ADMIN')) {


            yield MenuItem::subMenu('Compte', 'fas fa-user')->setSubItems([
                MenuItem::linkToCrud('Tous les Comptes', 'fas fa-user-friends', User::class),
                MenuItem::linkToCrud('Ajoutez', 'fas fa-plus', User::class)->setAction(Crud::PAGE_NEW),
            ]);
        }
            yield MenuItem::subMenu('Categories', 'fas fa-tags')->setSubItems([
                MenuItem::linkToCrud('Toutes les catégories', 'fas fa-list', Categories::class),
            ]);
            yield MenuItem::subMenu('Magasins', 'fas fa-home')->setSubItems([
                MenuItem::linkToCrud('Tous les magasins', 'fas fa-download', Magasins::class),
                MenuItem::linkToCrud('Nouveau', 'fas fa-plus', Magasins::class)->setAction(Crud::PAGE_NEW),
            ]);  
            yield MenuItem::subMenu('Catalogues', 'fas fa-book')->setSubItems([
                MenuItem::linkToCrud('Tous les catalogues', 'fas fa-download', Catalogues::class),
                MenuItem::linkToCrud('Ajoutez', 'fas fa-plus', Catalogues::class)->setAction(Crud::PAGE_NEW),
            ]);

            yield MenuItem::subMenu('Slider', 'fas fa-photo-video')->setSubItems([
                MenuItem::linkToCrud('Tous les sliders', 'fas fa-photo-video', Slider::class),
                MenuItem::linkToCrud('Ajoutez', 'fas fa-plus', Slider::class)->setAction(Crud::PAGE_NEW),
            ]);

            yield MenuItem::subMenu('Newsletter', 'fas fa-envelope')->setSubItems([
                MenuItem::linkToCrud('Carnet Email', 'fas fa-envelope', Subscriber::class),
                MenuItem::linkToRoute('Envoyer une Newsletter', 'fas fa-plus', 'app_newsletter'),
            ]);
        
            yield MenuItem::subMenu('Réglages', 'fas fa-cog')->setSubItems([
                MenuItem::linkToCrud('Général', 'fas fa-cog', Option::class),
            ]);
        
    }
}
