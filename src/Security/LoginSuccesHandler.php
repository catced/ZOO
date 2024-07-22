<?php
namespace App\Security;

use Symfony\Bundle\SecurityBundle\Security as SecurityBundleSecurity;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Security;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private $router;
    private $security;

    public function __construct(RouterInterface $router, SecurityBundleSecurity $security)
    {
        $this->router = $router;
        $this->security = $security;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
    {
        $user = $token->getUser();

        if ($this->security->isGranted('ROLE_VETERINAIRE', $user)) {
            $response = new RedirectResponse($this->router->generate('veterinaire_dashboard'));
        } elseif ($this->security->isGranted('ROLE_EMPLOYE', $user)) {
            $response = new RedirectResponse($this->router->generate('user_dashboard'));
        } elseif ($this->security->isGranted('ROLE_ADMIN', $user)) {
            $response = new RedirectResponse($this->router->generate('admin_dashboard'));
        }else {
            $response = new RedirectResponse($this->router->generate('accueil'));
        }

        return $response;
    }
}
