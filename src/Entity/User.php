<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"="user_read"}
 * )
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("user_read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups("user_read")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups("user_read")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user_read")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("user_read")
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer")
     * @Groups("user_read")
     */
    private $bourse;

    /**
     * @ORM\OneToMany(targetEntity=Ludi::class, mappedBy="user", orphanRemoval=true)
     * @Groups("user_read")
     * @ApiSubresource()
     */
    private $ludis;

    public function __construct()
    {
        $this->ludis = new ArrayCollection();
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

    public function getBourse(): ?int
    {
        return $this->bourse;
    }

    public function setBourse(int $bourse): self
    {
        $this->bourse = $bourse;

        return $this;
    }

    /**
     * @return Collection<int, Ludi>
     */
    public function getLudis(): Collection
    {
        return $this->ludis;
    }

    public function addLudi(Ludi $ludi): self
    {
        if (!$this->ludis->contains($ludi)) {
            $this->ludis[] = $ludi;
            $ludi->setUser($this);
        }

        return $this;
    }

    public function removeLudi(Ludi $ludi): self
    {
        if ($this->ludis->removeElement($ludi)) {
            // set the owning side to null (unless already changed)
            if ($ludi->getUser() === $this) {
                $ludi->setUser(null);
            }
        }

        return $this;
    }
}
