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

class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request)
    {
        $formLogin = $this->createFormLogin();
        $formLogin->handleRequest($request);
        if($formLogin->isSubmitted() && $formLogin->isValid()){
            $mail = $formLogin['mailAddress']->getData();
            $password = $formLogin['password']->getData();
            $user = $this->fetchUser($mail, $password);
            return $this->render('login/user.html.twig',
                array(
                    'user' => $user,
                    'title' => 'info utilisateur'
                ));
        }
        return $this->render('login/login.html.twig',
                array(
                    'formLogin' => $formLogin->createView(),
                    'title' => 'Connexion'
                ));
    }
    
    private function createFormLogin(){
        return $this->createFormBuilder()
                ->add('mailAddress', EmailType::class)
                ->add('password', PasswordType::class)
                ->add('submit', SubmitType::class)
                ->getForm();
    }
    
    private function fetchUser(string $mail, string $password){
        $repository = $this->getDoctrine()->getManager()->getRepository(User::class);
        $result = $repository->findOneBy(array(
            'mail' => $mail,
            'password' => $password
        ));
        return $result;
    }
}
