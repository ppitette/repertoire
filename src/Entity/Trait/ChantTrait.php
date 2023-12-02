<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;

trait ChantTrait
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(nullable: true)]
    private ?int $annee = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $cote = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $coteNew = null;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $snpls = null;

    public function __toString()
    {
        return $this->cote.' '.$this->titre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(?int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getCote(): ?string
    {
        return $this->cote;
    }

    public function setCote(string $cote): self
    {
        $this->cote = $cote;

        return $this;
    }

    public function getCoteNew(): ?string
    {
        return $this->coteNew;
    }

    public function setCoteNew(?string $coteNew): self
    {
        $this->coteNew = $coteNew;

        return $this;
    }

    public function getSnpls(): ?string
    {
        return $this->snpls;
    }

    public function setSnpls(?string $snpls): self
    {
        $this->snpls = $snpls;

        return $this;
    }
}
