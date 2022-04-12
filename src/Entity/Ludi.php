<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\LudiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LudiRepository::class)
 * @ApiResource()
 */
class Ludi
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("ludi_read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("ludi_read")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("ludi_read")
     */
    private $specialite;

    /**
     * @ORM\Column(type="boolean")
     * @Groups("ludi_read")
     */
    private $complet;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="ludis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Gladiateur::class, mappedBy="ludi", orphanRemoval=true)
     */
    private $gladiateurs;

    public function __construct()
    {
        $this->gladiateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSpecialite(): ?string
    {
        return $this->specialite;
    }

    public function setSpecialite(string $specialite): self
    {
        $this->specialite = $specialite;

        return $this;
    }

    public function getComplet(): ?bool
    {
        return $this->complet;
    }

    public function setComplet(bool $complet): self
    {
        $this->complet = $complet;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Gladiateur>
     */
    public function getGladiateurs(): Collection
    {
        return $this->gladiateurs;
    }

    public function addGladiateur(Gladiateur $gladiateur): self
    {
        if (!$this->gladiateurs->contains($gladiateur)) {
            $this->gladiateurs[] = $gladiateur;
            $gladiateur->setLudi($this);
        }

        return $this;
    }

    public function removeGladiateur(Gladiateur $gladiateur): self
    {
        if ($this->gladiateurs->removeElement($gladiateur)) {
            // set the owning side to null (unless already changed)
            if ($gladiateur->getLudi() === $this) {
                $gladiateur->setLudi(null);
            }
        }

        return $this;
    }
}
