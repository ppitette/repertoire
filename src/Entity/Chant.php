<?php

namespace App\Entity;

use App\Repository\ChantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;

#[ORM\Entity(repositoryClass: ChantRepository::class)]
class Chant
{
    use Trait\ChantTrait;

    #[ORM\Column(length: 25, nullable: true)]
    private ?string $coteEdit = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $source = null;

    #[ORM\Column(nullable: true)]
    private ?int $secli = null;

    #[ORM\Column]
    private ?bool $ordinaire = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $texte = null;

    #[ORM\ManyToOne(inversedBy: 'chants')]
    private ?Editeur $editeur = null;

    #[ORM\ManyToMany(targetEntity: Artiste::class, inversedBy: 'artAuteur')]
    #[JoinTable(name: 'chants_auteurs')]
    private Collection $auteur;

    #[ORM\ManyToMany(targetEntity: Artiste::class, inversedBy: 'artCompositeur')]
    #[JoinTable(name: 'chants_compositeurs')]
    private Collection $compositeur;

    public function __construct()
    {
        $this->auteur = new ArrayCollection();
        $this->compositeur = new ArrayCollection();
    }

    public function getAffich(): ?string
    {
        if ($this->coteEdit) {
            if (str_starts_with($this->coteEdit, 'IEV')) {
                return $this->titre.' ('.$this->coteEdit.')';
            }
        }

        if (!$this->cote) {
            if (!$this->coteNew) {
                if (!$this->coteEdit) {
                    return $this->titre;
                } else {
                    return $this->titre.' ('.$this->coteEdit.')';
                }
            } elseif (!$this->coteEdit) {
                return $this->titre.' ('.$this->coteNew.')';
            } else {
                return $this->coteEdit;
            }
        } else {
            return $this->titre.' ('.$this->cote.')';
        }

        return '';
    }

    public function getCoteEdit(): ?string
    {
        return $this->coteEdit;
    }

    public function setCoteEdit(?string $coteEdit): self
    {
        $this->coteEdit = $coteEdit;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getSecli(): ?int
    {
        return $this->secli;
    }

    public function setSecli(?int $secli): self
    {
        $this->secli = $secli;

        return $this;
    }

    public function isOrdinaire(): ?bool
    {
        return $this->ordinaire;
    }

    public function setOrdinaire(bool $ordinaire): self
    {
        $this->ordinaire = $ordinaire;

        return $this;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(?string $texte): self
    {
        $this->texte = $texte;

        return $this;
    }

    public function getEditeur(): ?Editeur
    {
        return $this->editeur;
    }

    public function setEditeur(?Editeur $editeur): self
    {
        $this->editeur = $editeur;

        return $this;
    }

    /**
     * @return Collection<int, Artiste>
     */
    public function getAuteur(): Collection
    {
        return $this->auteur;
    }

    public function addAuteur(Artiste $auteur): self
    {
        if (!$this->auteur->contains($auteur)) {
            $this->auteur->add($auteur);
        }

        return $this;
    }

    public function removeAuteur(Artiste $auteur): self
    {
        $this->auteur->removeElement($auteur);

        return $this;
    }

    /**
     * @return Collection<int, Artiste>
     */
    public function getCompositeur(): Collection
    {
        return $this->compositeur;
    }

    public function addCompositeur(Artiste $compositeur): self
    {
        if (!$this->compositeur->contains($compositeur)) {
            $this->compositeur->add($compositeur);
        }

        return $this;
    }

    public function removeCompositeur(Artiste $compositeur): self
    {
        $this->compositeur->removeElement($compositeur);

        return $this;
    }
}
