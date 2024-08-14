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
    #[Route('/subscriber', name: 'app_subscriber')] // Route to handle subscriber form submission. // Route pour gérer la soumission du formulaire d'abonnement.
    public function index(Request $request, EntityManagerInterface $em, SubscriberRepository $newsletterRepository): Response
    {
        $newsForm = $this->createForm(SubscriberType::class, new Subscriber()); // Create a form for subscribers with a new Subscriber object. // Création d'un formulaire pour les abonnés avec un nouvel objet Subscriber.

        $newsForm->handleRequest($request); // Handle the form submission data. // Gestion des données envoyées via le formulaire.

        if ($newsForm->isSubmitted() && $newsForm->isValid()) { // Check if the form is submitted and valid. // Vérifiez si le formulaire est soumis et valide.
            /** @var Subscriber $data */
            $data = $newsForm->getData(); // Retrieve the data from the form. // Récupération des données du formulaire.

            $existingNewsletter = $newsletterRepository->findOneByEmail($data->getEmail()); // Check if the email already exists in the database. // Vérifiez si l'email existe déjà dans la base de données.

            if ($existingNewsletter) { // If the email already exists, add an error message. // Si l'email existe déjà, ajoutez un message d'erreur.
                $this->addFlash('error', 'Cet email est déjà inscrit à la newsletter.'); // Add an error message. // Ajouter un message d'erreur.

                return $this->redirectToRoute('app_subscriber'); // Redirect to the same page so the user can correct the error. // Rediriger vers la même page pour que l'utilisateur puisse corriger l'erreur.
            }

            $news = new Subscriber($data->getEmail()); // Create a new subscriber and mark it as valid. // Créez un nouvel abonné et marquez-le comme valide.
            $news->setIsValid(true); // Set the subscriber as valid. // Marquez l'abonné comme valide.
            $em->persist($news); // Persist the new subscriber entity. // Persister la nouvelle entité abonné.

            $em->flush(); // Save the changes to the database. // Enregistrez les changements dans la base de données.

            $this->addFlash('success', 'Vous êtes maintenant inscrit à la newsletter de Reflets Bleus.'); // Add a success message and redirect to the homepage. // Ajouter un message de succès et rediriger vers la page d'accueil.
            return $this->redirectToRoute('home'); // Redirect to the homepage. // Rediriger vers la page d'accueil.
        }

        return $this->render('subscriber/index.html.twig', [ // Render the form in the view. // Rendu du formulaire dans la vue.
            'form_sub' => $newsForm->createView(), // Passes the form view to the Twig template. // Passe la vue du formulaire au modèle Twig.
            'title' => 'Newsletter', // Title for the page. // Titre de la page.
        ]);
    }
}
