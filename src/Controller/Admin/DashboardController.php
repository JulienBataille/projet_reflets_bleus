<?php

namespace App\Controller\Admin;

use App\Entity\Catalogues;
use App\Entity\User;
use App\Entity\Media;
use App\Entity\Option;
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

        if($this->isGranted('ROLE_AUTHOR')){
            
         yield MenuItem::subMenu('Catalogues', 'fas fa-book')->setSubItems([
            MenuItem::linkToCrud('Tous les catalogues', 'fas fa-download', Catalogues::class),
            MenuItem::linkToCrud('Ajoutez', 'fas fa-plus', Catalogues::class)->setAction(Crud::PAGE_NEW),
    
        ]);

        yield MenuItem::subMenu('Media', 'fas fa-photo-video')->setSubItems([
            MenuItem::linkToCrud('Médiathèque', 'fas fa-photo-video', Media::class),
            MenuItem::linkToCrud('Ajoutez', 'fas fa-plus', Media::class)->setAction(Crud::PAGE_NEW),
        ]);

        yield MenuItem::subMenu('Newsletter', 'fas fa-envelope')->setSubItems([
            MenuItem::linkToCrud('Carnet Email', 'fas fa-envelope', Subscriber::class),
            MenuItem::linkToRoute('Envoyer une Newsletter', 'fas fa-plus', 'app_newsletter'),
        ]);

        }

        if($this->isGranted('ROLE_ADMIN')){


            yield MenuItem::subMenu('Réglages', 'fas fa-cog')->setSubItems([
                MenuItem::linkToCrud('Général', 'fas fa-cog', Option::class),
            ]);

        }
        

        
    

    }
}