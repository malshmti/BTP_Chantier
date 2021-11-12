<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TacheRepository::class)
 */
class Tache
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
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree;

    /**
     * @ORM\ManyToOne(targetEntity=Prestataire::class, inversedBy="taches")
     */
    private $prestataire;

    /**
     * @ORM\ManyToOne(targetEntity=Phase::class, inversedBy="taches")
     */
    private $phase;

    /**
     * @ORM\OneToOne(targetEntity=ApprobationTache::class, mappedBy="tache", cascade={"persist", "remove"})
     */
    private $approbationTache;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getPrestataire(): ?Prestataire
    {
        return $this->prestataire;
    }

    public function setPrestataire(?Prestataire $prestataire): self
    {
        $this->prestataire = $prestataire;

        return $this;
    }

    public function getPhase(): ?Phase
    {
        return $this->phase;
    }

    public function setPhase(?Phase $phase): self
    {
        $this->phase = $phase;

        return $this;
    }

    public function getApprobationTache(): ?ApprobationTache
    {
        return $this->approbationTache;
    }

    public function setApprobationTache(ApprobationTache $approbationTache): self
    {
        // set the owning side of the relation if necessary
        if ($approbationTache->getTache() !== $this) {
            $approbationTache->setTache($this);
        }

        $this->approbationTache = $approbationTache;

        return $this;
    }
}
