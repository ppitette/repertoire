<?php

namespace App\Entity;

use App\Repository\SecliRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SecliRepository::class)]
class Secli
{
    use Trait\ChantTrait;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $auteur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $compositeur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $editeur = null;

    #[ORM\Column]
    private ?int $fiche = null;

    #[ORM\Column]
    private ?bool $importe = null;

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(?string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getCompositeur(): ?string
    {
        return $this->compositeur;
    }

    public function setCompositeur(?string $compositeur): self
    {
        $this->compositeur = $compositeur;

        return $this;
    }

    public function getEditeur(): ?string
    {
        return $this->editeur;
    }

    public function setEditeur(?string $editeur): self
    {
        $this->editeur = $editeur;

        return $this;
    }

    public function getFiche(): ?int
    {
        return $this->fiche;
    }

    public function setFiche(int $fiche): self
    {
        $this->fiche = $fiche;

        return $this;
    }

    public function isImporte(): ?bool
    {
        return $this->importe;
    }

    public function setImporte(bool $importe): self
    {
        $this->importe = $importe;

        return $this;
    }
}
