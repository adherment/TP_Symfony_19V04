<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Employe;

class PrincipalController extends AbstractController
{
    /**
     * @Route("/principal", name="principal")
     */
    public function index()
    {
        return $this->render('principal/index.html.twig', [
            'controller_name' => 'PrincipalController',
        ]);
    }
    
    /**
     * @route("/welcome/{nom}")
     * @param type $nom
     * @return type
     */
    public function welcome($nom){
        return $this->render('principal/welcome.html.twig', array("nom" => $nom));
    }
    
    /**
     * @route("/employes", name="employes")
     * @param \App\Controller\ManagerRegistry $doctrine
     * @return type
     */
    public function afficheEmployes(ManagerRegistry $doctrine){
        $employes = $doctrine->getRepository(Employe::class)->findAll();
        $titre = "Liste des employés";
        return $this->render('principal/employes.html.twig', compact('titre', 'employes'));
    }
    
    /**
     * @route("/employe/{id}")
     * @param ManagerRegistry $doctrine
     * @param int $id
     * @return type
     */
    public function afficheUnEmploye(ManagerRegistry $doctrine, int $id){
        $employe = $doctrine->getRepository(Employe::class)->find($id);
        $titre = "Employe n° " . $id;
        return $this->render('principal/unemploye.html.twig', compact('titre', 'employe'));
    }
    
    /**
     * @route("/employetout/{id}", name="employetout", requirements={"id":"\d+"})
     * @param ManagerRegistry $doctrine
     * @param int $id
     * @return type
     */
    public function afficheUnEmployeTout(ManagerRegistry $doctrine, int $id){
        $employe = $doctrine->getRepository(Employe::class)->find($id);
        $titre = "Employen° " . $id;
        return $this->render('principal/unemployetout.html.twig', compact('titre', 'employe'));
    }
}
