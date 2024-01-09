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
    private $cv;

    #[ORM\ManyToOne(inversedBy: 'etudiantPostes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etudiant $etudiant = null;

    #[ORM\ManyToOne(inversedBy: 'etudiantPostes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Poste $Poste = null;

    #[ORM\Column(length: 10)]
    private ?string $statut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCv()
    {
        if (null == $this->cv) {
            return null;
        }

        return 'data:image/jpg;base64,'.base64_encode(stream_get_contents($this->cv));
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

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }
}
