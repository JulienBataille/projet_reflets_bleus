<?php

namespace App\Controller\Menu;



use App\Entity\Option;
use App\Repository\OptionRepository;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    public function index (CategoriesRepository $categories, Request $request, OptionRepository $options, EntityManagerInterface $em) : Response
    {
        $tel = $em->getRepository(Option::class)->findOneBy(['name'=>'tel']);
        $mail = $em->getRepository(Option::class)->findOneBy(['name'=>'mail']);

        return $this->render('_partials/header.html.twig',[
                'categories' => $categories->findAll(),
                'tel' => $tel,
                'mail' => $mail,

        ]);
    }
}