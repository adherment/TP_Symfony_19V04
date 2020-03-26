<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use \Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\User;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Security;

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('login/login.html.twig', array(
                    'last_username' => $lastUsername,
                    'error' => $error,
                    'title' => "login"
                ));
    }
    
    /**
     * @Route("/user", name="user")
     * @param Security $security
     */
    public function showUser(Security $security){
        $user = $security->getUser();
        return $this->render('login/user.html.twig', array(
            'user' => $user,
            'title' => "login"
        ));
    }
    
    /**
     * @Route("/logout", name="logout")
     */
    public function logout(){
        return $this->render(array(
            'login/login.html.twig',
            'title' => "deconnexion"
        ));
    }
}
