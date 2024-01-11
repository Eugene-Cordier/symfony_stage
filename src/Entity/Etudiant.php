<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Il y a déja un compte avec cette adresse email')]
class Etudiant implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Length(
        min: 2,
        max: 30,
        minMessage: 'Le login doit comporter au moins {{ limit }} caractères',
        maxMessage: 'Le login est limité à {{ limit }} caractères',
    )]
    #[Assert\NotBlank]
    #[ORM\Column(length: 30)]
    private ?string $login = null;

    #[Assert\Length(
        min: 2,
        max: 180,
        minMessage: 'L\'email doit comporter au moins {{ limit }} caractères',
        maxMessage: 'L\'email est limité à {{ limit }} caractères',
    )]
    #[Assert\NotBlank]
    #[Assert\Email(message: 'L\'email {{ value }} n\'est pas valide.', )]
    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Le nom doit comporter au moins {{ limit }} caractères',
        maxMessage: 'Le nom est limité à {{ limit }} caractères',
    )]
    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Le prénom doit comporter au moins {{ limit }} caractères',
        maxMessage: 'Le prénom est limité à {{ limit }} caractères',
    )]
    #[Assert\NotBlank]
    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    /**
     * @var ?string The hashed password
     */
    #[Assert\Length(
        min: 8,
        max: 255,
        minMessage: 'Votre mot de passe doit comporter au moins {{ limit }} caractères',
        maxMessage: 'Le mot de passe est limité à {{ limit }} caractères',
    )]
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'etudiant', targetEntity: EtudiantPoste::class)]
    private Collection $etudiantPostes;

    public function __construct()
    {
        $this->postes = new ArrayCollection();
        $this->etudiantPostes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return [];
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
        }

        return $this;
    }

    public function removePoste(Poste $poste): static
    {
        $this->postes->removeElement($poste);

        return $this;
    }

    /**
     * @return Collection<int, EtudiantPoste>
     */
    public function getEtudiantPostes(): Collection
    {
        return $this->etudiantPostes;
    }

    public function addEtudiantPoste(EtudiantPoste $etudiantPoste): static
    {
        if (!$this->etudiantPostes->contains($etudiantPoste)) {
            $this->etudiantPostes->add($etudiantPoste);
            $etudiantPoste->setEtudiant($this);
        }

        return $this;
    }

    public function removeEtudiantPoste(EtudiantPoste $etudiantPoste): static
    {
        if ($this->etudiantPostes->removeElement($etudiantPoste)) {
            // set the owning side to null (unless already changed)
            if ($etudiantPoste->getEtudiant() === $this) {
                $etudiantPoste->setEtudiant(null);
            }
        }

        return $this;
    }
}
