<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $addresse = null;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: Poste::class)]
    private Collection $postes;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: Recruteur::class)]
    private Collection $recruteurs;

    public function __construct()
    {
        $this->postes = new ArrayCollection();
        $this->recruteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAddresse(): ?string
    {
        return $this->addresse;
    }

    public function setAddresse(string $addresse): static
    {
        $this->addresse = $addresse;

        return $this;
    }

    /**
     * @return Collection<int, Poste>
     */
    public function getPostes(): Collection
    {
        return $this->postes;
    }

    public function addPoste(Poste $poste): static
    {
        if (!$this->postes->contains($poste)) {
            $this->postes->add($poste);
            $poste->setEntreprise($this);
        }

        return $this;
    }

    public function removePoste(Poste $poste): static
    {
        if ($this->postes->removeElement($poste)) {
            // set the owning side to null (unless already changed)
            if ($poste->getEntreprise() === $this) {
                $poste->setEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Recruteur>
     */
    public function getRecruteurs(): Collection
    {
        return $this->recruteurs;
    }

    public function addRecruteur(Recruteur $recruteur): static
    {
        if (!$this->recruteurs->contains($recruteur)) {
            $this->recruteurs->add($recruteur);
            $recruteur->setEntreprise($this);
        }

        return $this;
    }

    public function removeRecruteur(Recruteur $recruteur): static
    {
        if ($this->recruteurs->removeElement($recruteur)) {
            // set the owning side to null (unless already changed)
            if ($recruteur->getEntreprise() === $this) {
                $recruteur->setEntreprise(null);
            }
        }

        return $this;
    }
}
