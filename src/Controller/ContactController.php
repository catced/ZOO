<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Psr\Log\LoggerInterface;


class ContactController extends AbstractController
{


#[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, MailerInterface $mailer, LoggerInterface $logger): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                // Send email
                $email = (new TemplatedEmail())
                    ->from($contact->getEmail())
                    ->to('catced@gmail.com')
                    ->subject($contact->getTitle())
                    ->htmlTemplate('contact/email.html.twig')
                    ->context([
                        'title' => $contact->getTitle(),
                        'description' => $contact->getDescription(),
                        'contactEmail' => $contact->getEmail(),
                    ]);
                  
                $mailer->send($email);
               
                $logger->info('Email envoyé correctement.');

                return $this->redirectToRoute('contact_success');
            } catch (TransportExceptionInterface $e) {
                $logger->error('Echec lors de l\'envoi du mail: ' . $e->getMessage());
                // Optionally, add flash message or other error handling
            }
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/contact/success', name: 'contact_success')]
    public function success(): Response
    {
        return $this->render('contact/success.html.twig');
    }
}
