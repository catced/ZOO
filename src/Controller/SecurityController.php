<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
       
        // gestion erreur si pb de login
        $error = $authenticationUtils->getLastAuthenticationError();
        // dernier username entré
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('Cette méthode peut être vide.');
    }

    // #[Route(path: '/redirect', name: 'app_redirect')]
    // public function redirectToDashboard(Request $request): RedirectResponse
    // {
    //     $user = '';
       
    //     if ($this->isGranted('ROLE_EMPLOYE')) {
    //         return $this->redirectToRoute('user/dashboard');
    //     }
    //     if ($this->isGranted('ROLE_ADMIN')) {
    //         return $this->redirectToRoute('admin/dashboard');
    //     }
    //     if ($this->isGranted('ROLE_VETERINAIRE')) {
    //         return $this->redirectToRoute('veterinaire/dashboard');
    //     }
        
    //  }   
}