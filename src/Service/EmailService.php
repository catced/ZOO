<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendUserCreationEmail(string $toEmail, string $username)
    {
        
        $email = (new Email())
            ->from('catced@gmail.com')
            ->to($toEmail)
            ->subject('Your account has been created')
            ->html('<p>Dear ' . $username . ', your account has been created successfully.</p>');

        $this->mailer->send($email);
    }
}