<?php

namespace App\Entity;

use App\Repository\EditeurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EditeurRepository::class)]
class Editeur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libSecli = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $adresse = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $telecopie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $courriel = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $site = null;

    #[ORM\OneToMany(mappedBy: 'editeur', targetEntity: Chant::class)]
    private Collection $chants;

    public function __construct()
    {
        $this->chants = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->libSecli;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibSecli(): ?string
    {
        return $this->libSecli;
    }

    public function setLibSecli(string $libSecli): self
    {
        $this->libSecli = $libSecli;

        return $this;
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getTelecopie(): ?string
    {
        return $this->telecopie;
    }

    public function setTelecopie(?string $telecopie): self
    {
        $this->telecopie = $telecopie;

        return $this;
    }

    public function getCourriel(): ?string
    {
        return $this->courriel;
    }

    public function setCourriel(?string $courriel): self
    {
        $this->courriel = $courriel;

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(?string $site): self
    {
        $this->site = $site;

        return $this;
    }

    /**
     * @return Collection<int, Chant>
     */
    public function getChants(): Collection
    {
        return $this->chants;
    }

    public function addChant(Chant $chant): self
    {
        if (!$this->chants->contains($chant)) {
            $this->chants->add($chant);
            $chant->setEditeur($this);
        }

        return $this;
    }

    public function removeChant(Chant $chant): self
    {
        if ($this->chants->removeElement($chant)) {
            // set the owning side to null (unless already changed)
            if ($chant->getEditeur() === $this) {
                $chant->setEditeur(null);
            }
        }

        return $this;
    }
}
