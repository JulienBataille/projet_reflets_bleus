<?php

namespace App\Controller;

use App\Form\Type\ContactType;
use App\Repository\OptionRepository;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    public function __construct(
        private MailerInterface $mailer,
        private OptionRepository $optionRepository
    ){}

    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $contactform = $this->createForm(ContactType::class);
        $contactform->handleRequest($request);
        $contactmail = $this->optionRepository->findOneBy(['name' => 'mail'])->getValue();

        if ($contactform->isSubmitted() && $contactform->isValid()) {
            $data = $contactform->getData();
            $subject = $data['subject'];
            $mail = $data['email'];

            $email = (new TemplatedEmail())
            ->from($mail)
            ->to($contactmail)
            ->subject($subject)
            ->htmlTemplate('email/contact.html.twig')
            ->context([
                'data' => $contactform->getData(),
            ]);
        
        $this->mailer->send($email);
        
            $this->addFlash('success', 'Votre message a été envoyé avec succès.');

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'form_contact' => $contactform->createView(),
            'title'=>'Nous contacter'
        ]);
    }
}
