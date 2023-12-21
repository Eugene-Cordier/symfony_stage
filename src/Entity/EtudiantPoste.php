<?php

namespace App\Entity;

use App\Repository\EtudiantPosteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantPosteRepository::class)]
class EtudiantPoste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BLOB)]
    private ?string $cv = null;

    #[ORM\ManyToOne(inversedBy: 'etudiantPostes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etudiant $etudiant = null;

    #[ORM\ManyToOne(inversedBy: 'etudiantPostes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Poste $Poste = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCv()
    {
        return $this->cv;
    }

    public function setCv($cv): static
    {
        $this->cv = $cv;

        return $this;
    }

    public function getEtudiant(): ?Etudiant
    {
        return $this->etudiant;
    }

    public function setEtudiant(?Etudiant $etudiant): static
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getPoste(): ?Poste
    {
        return $this->Poste;
    }

    public function setPoste(?Poste $Poste): static
    {
        $this->Poste = $Poste;

        return $this;
    }
}
