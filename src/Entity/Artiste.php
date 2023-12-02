<?php

namespace App\Entity;

use App\Repository\ArtisteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtisteRepository::class)]
class Artiste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $civilite = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 50)]
    private ?string $lastname = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $dateNaiss = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $dateDeces = null;

    #[ORM\ManyToMany(targetEntity: Chant::class, mappedBy: 'auteur')]
    private Collection $artAuteur;

    #[ORM\ManyToMany(targetEntity: Chant::class, mappedBy: 'compositeur')]
    private Collection $artCompositeur;

    public function __construct()
    {
        $this->artAuteur = new ArrayCollection();
        $this->artCompositeur = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->firstname.' '.$this->lastname;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(?string $civilite): self
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFullname(): string
    {
        return $this->lastname.' '.$this->firstname;
    }

    public function getDateNaiss(): ?string
    {
        return $this->dateNaiss;
    }

    public function setDateNaiss(?string $dateNaiss): self
    {
        $this->dateNaiss = $dateNaiss;

        return $this;
    }

    public function getDateDeces(): ?string
    {
        return $this->dateDeces;
    }

    public function setDateDeces(?string $dateDeces): self
    {
        $this->dateDeces = $dateDeces;

        return $this;
    }

    /**
     * @return Collection<int, Chant>
     */
    public function getArtAuteur(): Collection
    {
        return $this->artAuteur;
    }

    public function addArtAuteur(Chant $artAuteur): self
    {
        if (!$this->artAuteur->contains($artAuteur)) {
            $this->artAuteur->add($artAuteur);
            $artAuteur->addAuteur($this);
        }

        return $this;
    }

    public function removeArtAuteur(Chant $artAuteur): self
    {
        if ($this->artAuteur->removeElement($artAuteur)) {
            $artAuteur->removeAuteur($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Chant>
     */
    public function getArtCompositeur(): Collection
    {
        return $this->artCompositeur;
    }

    public function addArtCompositeur(Chant $artCompositeur): self
    {
        if (!$this->artCompositeur->contains($artCompositeur)) {
            $this->artCompositeur->add($artCompositeur);
            $artCompositeur->addCompositeur($this);
        }

        return $this;
    }

    public function removeArtCompositeur(Chant $artCompositeur): self
    {
        if ($this->artCompositeur->removeElement($artCompositeur)) {
            $artCompositeur->removeCompositeur($this);
        }

        return $this;
    }
}
