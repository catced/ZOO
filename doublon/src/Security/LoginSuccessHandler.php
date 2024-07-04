<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
    {
        // Example logic to determine where to redirect
        $user = $token->getUser();
        // if (in_array('ROLE_ADMIN', $user->getRoles(), true)) {
        //     $redirectUrl = $this->router->generate('admin_dashboard');
        // } else {
        //     $redirectUrl = $this->router->generate('user_dashboard');
        // }
        if (in_array('ROLE_ADMIN', $user->getRoles(), true)) {
            $redirectUrl = $this->router->generate('admin_dashboard');
        } elseif (in_array('ROLE_EMPLOYE', $user->getRoles(), true)) {
            $redirectUrl = $this->router->generate('user_dashboard');
        } elseif (in_array('ROLE_VETERINAIRE', $user->getRoles(), true)) {
            $redirectUrl = $this->router->generate('veto_dashboard');  
        } else {
            $redirectUrl = $this->router->generate('accueil');
        }

        return new RedirectResponse($redirectUrl);
    }
}