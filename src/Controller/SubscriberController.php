<?php

namespace App\Controller;

use App\Entity\Subscriber;
use App\Form\Type\SubscriberType;
use App\Repository\SubscriberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SubscriberController extends AbstractController
{
    #[Route('/subscriber', name: 'app_subscriber')]
    public function index(Request $request, EntityManagerInterface $em, SubscriberRepository $newsletterRepository): Response
    {

        $newsForm = $this->createForm(SubscriberType::class, new Subscriber());

        $newsForm->handleRequest($request);

        if ($newsForm->isSubmitted() && $newsForm->isValid()) {
            /** @var Newsletter $data */
            $data = $newsForm->getData();
                        // Vérifiez si l'email existe déjà dans la base de données
                        $existingNewsletter = $newsletterRepository->findOneByEmail($data->getEmail());

                        if ($existingNewsletter) {
                            // Si l'email existe déjà, ajoutez un message d'erreur
                            $this->addFlash('error', 'Cet email est déjà inscrit à la newsletter.');
            
                            return $this->redirectToRoute('app_subscriber');
                        }

            $news = new Subscriber($data->getEmail());

            $news->setIsValid(true);
            $em->persist($news);

            $em->flush();

            $this->addFlash('success', 'Vous êtes maintenant inscrit à la newsletter de Reflets Bleus.');
            return $this->redirectToRoute('home');

        }



        return $this->render('subscriber/index.html.twig',[
            'form_sub'=>$newsForm->createView(),
            'title'=>'Newsletter',
        ]);
    }
}
