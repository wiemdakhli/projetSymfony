<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="un compte avec ce email existe déja")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message="ce champ doit etre rempli")
     * @Assert\Email(message="cette adresse n'est pas valide")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Length(
     *      min = 6,
     *      minMessage = "votre mot de passe doit contenir au moins {{ limit }} characters"
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type(type="alpha",message="ce champ doit contenir que des lettres")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type(type="alpha",message="ce champ doit contenir que des lettres")
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(
     *      min = 8,
     *      exactMessage = "le numero de telephone doit contenir exactement {{ limit }} chiffres",
     *      max =8
     * )
     */
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="sender", orphanRemoval=true)
     */
    private $sent;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="recipient", orphanRemoval=true)
     */
    private $received;

    public function __construct()
    {
        $this->sent = new ArrayCollection();
        $this->received = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

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
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
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

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getSent(): Collection
    {
        return $this->sent;
    }

    public function addSent(Message $sent): self
    {
        if (!$this->sent->contains($sent)) {
            $this->sent[] = $sent;
            $sent->setSender($this);
        }

        return $this;
    }

    public function removeSent(Message $sent): self
    {
        if ($this->sent->removeElement($sent)) {
            // set the owning side to null (unless already changed)
            if ($sent->getSender() === $this) {
                $sent->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getReceived(): Collection
    {
        return $this->received;
    }

    public function addReceived(Message $received): self
    {
        if (!$this->received->contains($received)) {
            $this->received[] = $received;
            $received->setRecipient($this);
        }

        return $this;
    }

    public function removeReceived(Message $received): self
    {
        if ($this->received->removeElement($received)) {
            // set the owning side to null (unless already changed)
            if ($received->getRecipient() === $this) {
                $received->setRecipient(null);
            }
        }

        return $this;
    }
}
