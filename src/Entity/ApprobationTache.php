<?php

namespace App\Entity;

use App\Repository\ApprobationTacheRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ApprobationTacheRepository::class)
 */
class ApprobationTache
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Prestataire::class, inversedBy="yes", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $prestataire;

    /**
     * @ORM\OneToOne(targetEntity=Tache::class, inversedBy="approbationTache", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $tache;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrestataire(): ?Prestataire
    {
        return $this->prestataire;
    }

    public function setPrestataire(Prestataire $prestataire): self
    {
        $this->prestataire = $prestataire;

        return $this;
    }

    public function getTache(): ?Tache
    {
        return $this->tache;
    }

    public function setTache(Tache $tache): self
    {
        $this->tache = $tache;

        return $this;
    }
}
