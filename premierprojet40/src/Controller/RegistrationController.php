<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\UserType;
use App\Entity\User;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     */
    public function index()
    {
        return $this->render('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
        ]);
    }
    
    /**
     * @Route("/testform", name="testform")
     * @param Request $request
     * @param ManagerRegistry $doctrine
     * @return type
     */
    public function testForm(Request $request, ManagerRegistry $doctrine){
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        return $this->render('registration/testuser.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    /**
     * @Route("/register", name="user_registration")
     * @param Request $request
     * @return type
     */
    public function register(Request $request) {
        //Construction du formulaire
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        
        //Test si c'est un retour de formulaire et qu'il est valide
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //On stocke l'utilisateur en BD
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            //on rappelle le formulaire
            return $this->render(
                    'registration/register.html.twig', array(
                        'form' => $form->createView()
                    ));
        }
        return $this->render(
                    'registration/register.html.twig', array(
                        'form' => $form->createView()
                    ));
    }
}
