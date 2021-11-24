<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TacheRepository::class)
 */
class Tache implements \JsonSerializable
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
     * @ORM\JoinColumn(nullable=false)
     */
    private $phase;

    /**
     * @ORM\OneToOne(targetEntity=ApprobationTache::class, mappedBy="tache", cascade={"persist", "remove"})
     */
    private $approbationTache;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dureeReelle;

    /**
     * @ORM\OneToOne(targetEntity=Tache::class, cascade={"persist", "remove"})
     */
    private $dependanceTache;

    public function __construct() 
    {
        $this->dateDebut = new DateTime("now", new DateTimeZone('Europe/Paris'));
    }

    public function __toString()
    {
        return sprintf(' %s de la phase %s', $this->nom, $this->phase->getNom());
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'description' => $this->description,
            'prestataire' => $this->prestataire
        ];
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

    public function getDureeReelle(): ?int
    {
        return $this->dureeReelle;
    }

    public function setDureeReelle(?int $dureeReelle): self
    {
        $this->dureeReelle = $dureeReelle;

        return $this;
    }

    public function getDependanceTache(): ?self
    {
        return $this->dependanceTache;
    }

    public function setDependanceTache(?self $dependanceTache): self
    {
        $this->dependanceTache = $dependanceTache;

        return $this;
    }
}
