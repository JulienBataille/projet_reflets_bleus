<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Form\Type\NewsletterType;
use App\Repository\NewsletterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsletterController extends AbstractController
{
    #[Route('/newsletter', name: 'app_newsletter')]
    public function index(Request $request, EntityManagerInterface $em, NewsletterRepository $newsletterRepository): Response
    {

        $newsForm = $this->createForm(NewsletterType::class, new Newsletter());

        $newsForm->handleRequest($request);

        if ($newsForm->isSubmitted() && $newsForm->isValid()) {
            /** @var Newsletter $data */
            $data = $newsForm->getData();
                        // Vérifiez si l'email existe déjà dans la base de données
                        $existingNewsletter = $newsletterRepository->findOneByEmail($data->getEmail());

                        if ($existingNewsletter) {
                            // Si l'email existe déjà, ajoutez un message d'erreur
                            $this->addFlash('error', 'Cet email est déjà inscrit à la newsletter.');
            
                            return $this->redirectToRoute('app_newsletter');
                        }

            $news = new Newsletter($data->getEmail());

            $news->setIsValid(true);
            $em->persist($news);

            $em->flush();

            $this->addFlash('success', 'Vous êtes maintenant inscrit à la newsletter de Reflets Bleus.');
            return $this->redirectToRoute('home');

        }



        return $this->render('newsletter/index.html.twig',[
            'form_news'=>$newsForm->createView(),
            'title'=>'Newsletter',
        ]);
    }
}
