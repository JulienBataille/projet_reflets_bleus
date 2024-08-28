<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Option;
use App\Model\WelcomeModel;
use App\Form\Type\WelcomeType;
use App\Service\OptionService;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(CategoriesRepository $categories): Response
    {
        // Récupération de toutes les catégories
        $categoriesList = $categories->findAll();
        
        // Initialisation des couleurs par défaut
        $iconLight = '#41AED1'; // Couleur par défaut
        $iconDark = '#0E3F78';  // Couleur par défaut

        // Si des catégories existent, utilisez les couleurs de la première catégorie comme exemple
        if (!empty($categoriesList)) {
            $firstCategory = $categoriesList[0];
            $iconLight = $firstCategory->getIconLight() ?? $iconLight;
            $iconDark = $firstCategory->getIconDark() ?? $iconDark;
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'MainController', // Nom du contrôleur.
            'categories' => $categoriesList, // Récupère toutes les catégories depuis le repository.
            'title' => 'home', // Titre de la page.
            'iconLight' => $iconLight, // Couleur claire des icônes.
            'iconDark' => $iconDark,  // Couleur sombre des icônes.
        ]);
    }

    #[Route('/welcome', name: 'welcome')]
    public function welcome(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher, OptionService $optionService): Response
    {
        if ($optionService->getValue(WelcomeModel::SITE_INSTALLED_NAME)) {
            return $this->redirectToRoute('home'); // Redirects to home if the site is already installed. // Redirige vers la page d'accueil si le site est déjà installé.
        }

        $welcomeForm = $this->createForm(WelcomeType::class, new WelcomeModel()); // Creates a form for the WelcomeType using WelcomeModel. // Crée un formulaire pour WelcomeType en utilisant WelcomeModel.

        $welcomeForm->handleRequest($request); // Handles the request and populates the form with submitted data. // Gère la requête et remplit le formulaire avec les données soumises.

        if ($welcomeForm->isSubmitted() && $welcomeForm->isValid()) {
            /** @var WelcomeModel $data */
            $data = $welcomeForm->getData(); // Retrieves the form data. // Récupère les données du formulaire.

            // Creates and sets up a new Option entity indicating that the site is installed. // Crée et configure une nouvelle entité Option indiquant que le site est installé.
            $siteInstalled = new Option(WelcomeModel::SITE_INSTALLED_LABEL, WelcomeModel::SITE_INSTALLED_NAME, true, null);

            // Creates a new User entity and sets its properties. // Crée une nouvelle entité User et définit ses propriétés.
            $user = new User($data->getEmail());
            $user->setRoles(['ROLE_ADMIN']); // Sets the user role to ADMIN. // Définit le rôle de l'utilisateur sur ADMIN.
            $user->setPassword($passwordHasher->hashPassword($user, $data->getPassword())); // Hashes the user's password. // Hache le mot de passe de l'utilisateur.

            // Persists the new entities to the database. // Persiste les nouvelles entités dans la base de données.
            $em->persist($siteInstalled);
            $em->persist($user);
            $em->flush(); // Commits the changes to the database. // Valide les changements dans la base de données.

            return $this->redirectToRoute('home'); // Redirects to home after successful setup. // Redirige vers la page d'accueil après la configuration réussie.
        }

        return $this->render('home/welcome.html.twig', [
            'form' => $welcomeForm->createView(), // Passes the form view to the template. // Passe la vue du formulaire au template.
        ]);
    }
}
