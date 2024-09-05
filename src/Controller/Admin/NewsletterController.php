<?php

namespace App\Controller\Admin;

use Symfony\Component\Uid\Uuid;
use App\Form\Type\NewsletterFormType;
use Symfony\Component\Mime\Email;
use App\Repository\SubscriberRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsletterController extends AbstractController
{
    #[Route('/admin/newsletter', name: 'app_newsletter')]
    public function index(Request $request, SubscriberRepository $subscriberRepository, MailerInterface $mailer): Response
{
    $form = $this->createForm(NewsletterFormType::class);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $data = $form->getData();
        $title = $data['title'];
        $body = $data['body'];

        $subscribers = $subscriberRepository->findBy(['is_valid' => true]);

        foreach ($subscribers as $subscriber) {
            // Générer un token unique
            $unsubscribeToken = Uuid::v4()->toRfc4122();
            $subscriber->setUnsubscribeToken($unsubscribeToken);

            // Persister les changements
            $subscriberRepository->save($subscriber);

            // Créer le lien de désinscription
            $unsubscribeUrl = $this->generateUrl('app_unsubscribe', ['token' => $unsubscribeToken], UrlGeneratorInterface::ABSOLUTE_URL);



            $email = (new TemplatedEmail())
            ->from('test@gmail.com')
            ->to($subscriber->getEmail())
            ->subject($title)
            ->htmlTemplate('email/newsletter.html.twig') // Chemin vers le template Twig
                ->context([
                    'title' => $title, // Titre de la newsletter
                    'body' => $body, // Corps du message
                    'unsubscribeUrl' => $unsubscribeUrl, // Lien de désinscription généré dans votre contrôleur
                    'logoUrl' => 'https://www.votre-site.com/path/to/logo.png', // URL du logo de Reflets Bleus
                ]);

            $mailer->send($email);


        }

        $this->addFlash('success', 'La newsletter a été envoyée avec succès.');

        return $this->redirectToRoute('app_newsletter');
    }

    return $this->render('newsletter/index.html.twig', [
        'form_news' => $form->createView(),
        'title'=>'Newsletter'
    ]);
}


    #[Route('/unsubscribe/{token}', name: 'app_unsubscribe')]
        public function unsubscribe(string $token, SubscriberRepository $subscriberRepository): Response
        {
            $subscriber = $subscriberRepository->findOneBy(['unsubscribeToken' => $token]);

            if ($subscriber) {
                $subscriberRepository->remove($subscriber, true);

                $this->addFlash('success', 'Vous avez été désinscrit de la newsletter.');
            } else {
                $this->addFlash('error', 'Le lien de désinscription est invalide.');
            }

            return $this->redirectToRoute('home');
}

}
