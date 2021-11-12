<?php

namespace App\Entity;

use App\Repository\MateriauRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MateriauRepository::class)
 */
class Materiau
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $prixKg;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="materiaux")
     */
    private $commande;

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

    public function getPrixKg(): ?int
    {
        return $this->prixKg;
    }

    public function setPrixKg(int $prixKg): self
    {
        $this->prixKg = $prixKg;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }
}
