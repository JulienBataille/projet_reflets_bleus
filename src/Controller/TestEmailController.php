<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class TestEmailController extends AbstractController
{
    #[Route('/test-email', name: 'test_email')]
    public function testEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('your-email@gmail.com')
            ->to('recipient@example.com')
            ->subject('Test Email')
            ->text('This is a test email sent using Gmail SMTP.');

        $mailer->send($email);

        return new Response('Test email sent!');
    }
}
