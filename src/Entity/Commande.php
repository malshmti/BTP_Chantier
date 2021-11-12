<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
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
    private $quantite;

    /**
     * @ORM\OneToMany(targetEntity=Materiau::class, mappedBy="commande")
     */
    private $materiaux;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFacture;

    public function __construct()
    {
        $this->materiaux = new ArrayCollection();
    }

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

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * @return Collection|Materiau[]
     */
    public function getMateriaux(): Collection
    {
        return $this->materiaux;
    }

    public function addMateriaux(Materiau $materiaux): self
    {
        if (!$this->materiaux->contains($materiaux)) {
            $this->materiaux[] = $materiaux;
            $materiaux->setCommande($this);
        }

        return $this;
    }

    public function removeMateriaux(Materiau $materiaux): self
    {
        if ($this->materiaux->removeElement($materiaux)) {
            // set the owning side to null (unless already changed)
            if ($materiaux->getCommande() === $this) {
                $materiaux->setCommande(null);
            }
        }

        return $this;
    }

    public function getDateFacture(): ?\DateTimeInterface
    {
        return $this->dateFacture;
    }

    public function setDateFacture(\DateTimeInterface $dateFacture): self
    {
        $this->dateFacture = $dateFacture;

        return $this;
    }
}
