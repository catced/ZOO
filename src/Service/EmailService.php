<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Psr\Log\LoggerInterface;

class EmailService
{
    private $mailer;
    private $logger;

    public function __construct(MailerInterface $mailer, LoggerInterface $logger)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    public function sendUserCreationEmail(string $recipientEmail, string $username): void
    {
        $email = (new Email())
            ->from('no-reply@yourdomain.com')
            ->to($recipientEmail)
            ->subject('Welcome to Our Service')
            ->text(sprintf('Hello %s, welcome to our service!', $username));

        // Log the email details
        $this->logger->info('Preparing to send email', [
            'recipient' => $recipientEmail,
            'subject' => $email->getSubject(),
            'body' => $email->getTextBody(),
        ]);

        $this->mailer->send($email);

        // Log the email sent status
        $this->logger->info('Email sent successfully', [
            'recipient' => $recipientEmail,
            'subject' => $email->getSubject(),
        ]);
    }
}
