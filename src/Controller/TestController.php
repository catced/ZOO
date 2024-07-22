<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class TestController extends AbstractController
{
    
    #[Route('test-email', name: 'test_email')]
    public function testEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('catced@gmail.com')
            ->to('cedric.caty@free.fr')
            ->subject('Test Email')
            ->html('<p>This is a test email.</p>');

        $mailer->send($email);

        return new Response('Email sent');
    }
}
