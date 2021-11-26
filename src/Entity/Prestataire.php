<?php

namespace App\Entity;

use App\Repository\PrestataireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrestataireRepository::class)
 */
class Prestataire extends User implements \JsonSerializable
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity=Tache::class, mappedBy="prestataire")
     */
    private $taches;

    /**
     * @ORM\OneToOne(targetEntity=ApprobationTache::class, mappedBy="prestataire", cascade={"persist", "remove"})
     */
    private $approbationTache;

    public function __construct()
    {
        $this->taches = new ArrayCollection();
    }

    public function __toString(): string
    {
        return sprintf("%s", $this->getEmail());
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'nom' => $this->nom,
            'telephone' => $this->telephone,

        ];
    }

    public function getId(): ?int
    {
        return parent::getId();
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection|Tache[]
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTach(Tache $tach): self
    {
        if (!$this->taches->contains($tach)) {
            $this->taches[] = $tach;
            $tach->setPrestataire($this);
        }

        return $this;
    }

    public function removeTach(Tache $tach): self
    {
        if ($this->taches->removeElement($tach)) {
            // set the owning side to null (unless already changed)
            if ($tach->getPrestataire() === $this) {
                $tach->setPrestataire(null);
            }
        }

        return $this;
    }

    public function getApprobationTach(): ?ApprobationTache
    {
        return $this->approbationTache;
    }

    public function setApprobationTach(ApprobationTache $approbationTach): self
    {
        // set the owning side of the relation if necessary
        if ($approbationTach->getPrestataire() !== $this) {
            $approbationTach->setPrestataire($this);
        }

        $this->approbationTach = $approbationTach;

        return $this;
    }
}
