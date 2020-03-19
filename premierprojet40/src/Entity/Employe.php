<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Lieu;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmployeRepository")
 */
class Employe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="decimal", precision=9, scale=2)
     */
    private $salaire;
    
    /**
     * @ORM\ManyToOne(targetEntity="Lieu", inversedBy="lesEmployes")
     * @ORM\JoinColumn(name="idLieu", nullable=false)
     */
    private $lieu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSalaire(): ?string
    {
        return $this->salaire;
    }

    public function setSalaire(string $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }
    
    public function getLieu()
    {
        return $this->lieu;
    }
}
