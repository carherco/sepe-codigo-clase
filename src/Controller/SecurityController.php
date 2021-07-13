<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('c_r_u_d_fondo_index');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/login-json", name="login-json", methods={"POST"})
     */
    public function loginjson()
    {
        $user = $this->getUser();

        $token = sha1(random_bytes(12));
        //$user->setTokenSession($token);

        return $this->json([
            'username' => $user->getUserIdentifier(),
            'roles' => $user->getRoles(),
            'id' => $user->getId(),
            'token' => $token
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    // public function borrarlibro(Request $request)
    // {
    //     $token = $request->......;
    //     $user = $repoUser->findOneByTokenSession($token);

    //     $roles = $user->getRoles();
    // }
    
}
