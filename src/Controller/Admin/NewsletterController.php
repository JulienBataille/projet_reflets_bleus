<?php

namespace App\Controller\Admin;

use App\Form\NewsletterFormType;
use App\Repository\SubscriberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

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
                $email = (new Email())
                    ->from('test@gmail.com')
                    ->to($subscriber->getEmail())
                    ->subject($title)
                    ->text($body);

                $mailer->send($email);
            }

            $this->addFlash('success', 'La newsletter a été envoyée avec succès.');

            return $this->redirectToRoute('app_newsletter');
        }

        return $this->render('newsletter/index.html.twig', [
            'form_news' => $form->createView(),
        ]);
    }
}
