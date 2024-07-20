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
        return $this->render('home/index.html.twig', [
            'controller_name' => 'MainController',
            'categories' => $categories->findAll(),
            'title'=>'home'
        ]);
    }

    #[Route('/welcome', name: 'welcome')]
    public function welcome(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher, OptionService $optionService): Response
    {
        if ($optionService->getValue(WelcomeModel::SITE_INSTALLED_NAME)){
            return $this->redirectToRoute('home');
        }

        $welcomeForm = $this->createForm(WelcomeType::class, new WelcomeModel());

        $welcomeForm->handleRequest($request);

        if ($welcomeForm->isSubmitted() && $welcomeForm->isValid()) {
            /** @var WelcomeModel $data */
            $data = $welcomeForm->getData();

            $siteInstalled = new Option(WelcomeModel::SITE_INSTALLED_LABEL, WelcomeModel::SITE_INSTALLED_NAME, true, null) ;

            $user = new User($data->getEmail());
            $user->setRoles(['ROLE_ADMIN']);
            $user->setPassword($passwordHasher->hashPassword($user, $data->getPassword()));

            $em->persist($siteInstalled);
            $em->persist($user);

            $em->flush();

            return $this->redirectToRoute('home');

        }



        return $this->render('home/welcome.html.twig',[
            'form'=>$welcomeForm->createView(),
        ]);
    }
}
