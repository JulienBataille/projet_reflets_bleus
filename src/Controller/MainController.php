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
use Symfony\Component\HttpKernel\KernelInterface;
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
    public function welcome(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher, OptionService $optionService, KernelInterface $kernel): Response
    {
        $environnement = $kernel->getEnvironment();
        if ($environnement === 'prod') {
            return $this->redirectToRoute('home');
        } else {
            $welcomeForm = $this->createForm(WelcomeType::class, new WelcomeModel());

            $welcomeForm->handleRequest($request); 
    
            if ($welcomeForm->isSubmitted() && $welcomeForm->isValid()) {
                /** @var WelcomeModel $data */
                $data = $welcomeForm->getData(); 
    
                $user = new User($data->getEmail());
                $user->setRoles(['ROLE_ADMIN']);
                $user->setPassword($passwordHasher->hashPassword($user, $data->getPassword())); 
    
              
                $em->persist($user);
                $em->flush(); 
    
                return $this->redirectToRoute('home'); 
            }
    
            return $this->render('home/welcome.html.twig', [
                'form' => $welcomeForm->createView(), 
            ]);
        }






    }
}
