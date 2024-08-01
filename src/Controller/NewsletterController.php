<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\Type\NewsletterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsletterController extends AbstractController
{
    #[Route('/newsletter', name: 'app_newsletter')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {

        $newsForm = $this->createForm(NewsletterType::class, new Newsletter());

        $newsForm->handleRequest($request);

        if ($newsForm->isSubmitted() && $newsForm->isValid()) {
            /** @var Newsletter $data */
            $data = $newsForm->getData();


            $news = new Newsletter($data->getEmail());

            $news->setValid(true);
            dd($news);
            $em->persist($news);

            $em->flush();

            return $this->redirectToRoute('home');

        }



        return $this->render('newsletter/index.html.twig',[
            'form_news'=>$newsForm->createView(),
            'title'=>'Newsletter',
        ]);
    }
}
