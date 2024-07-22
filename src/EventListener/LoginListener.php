<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Psr\Log\LoggerInterface;

class LoginListener
{
    private $router;
    private $requestStack;


    public function __construct(RouterInterface $router, RequestStack $requestStack, LoggerInterface $logger)
    {
        $this->router = $router;
        $this->requestStack = $requestStack;

    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $user = $event->getAuthenticationToken()->getUser();
        $roles = $user->getRoles();
       
        


        $request = $this->requestStack->getCurrentRequest();
        $session = $request->getSession();
  
        // if (in_array('ROLE_ADMIN', $roles, true)) {
        //     $response = new RedirectResponse($this->router->generate('admin_dashboard'));
        // } elseif (in_array('ROLE_VETERINAIRE', $roles, true)) {
        //     $response = new RedirectResponse($this->router->generate('veterinaire_dashboard'));
        // } elseif (in_array('ROLE_EMPLOYE', $roles, true)) {
        //     $response = new RedirectResponse($this->router->generate('user_dashboard'));
        // } else {
        //     $response = new RedirectResponse($this->router->generate('accueil'));
        // }

        // $session->set('_security.main.target_path', $response->getTargetUrl());
    }
}
