<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\GladiateurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GladiateurRepository::class)
 * @ApiResource()
 */
class Gladiateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("gladiateur_read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("gladiateur_read")
     */
    private $nom;

    /**
     * @ORM\Column(type="float")
     *  @Groups("gladiateur_read")
     */
    private $adresse;

    /**
     * @ORM\Column(type="float")
     *  @Groups("gladiateur_read")
     */
    private $strength;

    /**
     * @ORM\Column(type="float")
     *  @Groups("gladiateur_read")
     */
    private $equilibre;

    /**
     * @ORM\Column(type="float")
     *  @Groups("gladiateur_read")
     */
    private $vitesse;

    /**
     * @ORM\Column(type="float")
     *  @Groups("gladiateur_read")
     */
    private $strategie;

    /**
     * @ORM\ManyToOne(targetEntity=Ludi::class, inversedBy="gladiateurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ludi;

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

    public function getAdresse(): ?float
    {
        return $this->adresse;
    }

    public function setAdresse(float $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getStrength(): ?float
    {
        return $this->strength;
    }

    public function setStrength(float $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getEquilibre(): ?float
    {
        return $this->equilibre;
    }

    public function setEquilibre(float $equilibre): self
    {
        $this->equilibre = $equilibre;

        return $this;
    }

    public function getVitesse(): ?float
    {
        return $this->vitesse;
    }

    public function setVitesse(float $vitesse): self
    {
        $this->vitesse = $vitesse;

        return $this;
    }

    public function getStrategie(): ?float
    {
        return $this->strategie;
    }

    public function setStrategie(float $strategie): self
    {
        $this->strategie = $strategie;

        return $this;
    }

    public function getLudi(): ?Ludi
    {
        return $this->ludi;
    }

    public function setLudi(?Ludi $ludi): self
    {
        $this->ludi = $ludi;

        return $this;
    }

    // JEU DU CIRQUE

    public function getValeurChar()
    {
        $random = rand(0,10) / 10;
        return 0.8 * $this->getAdresse() + $this->getEquilibre() + 0.3 * $this->getStrength() + 0.1 * $this->getVitesse() + $random;
    }

    public function getValeurLutte()
    {
        $random = rand(0,10) / 10;
        return 0.3 * $this->getAdresse() + 0.1 * $this->getEquilibre() + 0.8 * $this->getStrength() + 0.4 * $this->getVitesse() + $random;
    }

    public function getValeurAthletisme()
    {
        $random = rand(0,10) / 10;
        return 0.4 * $this->getAdresse() + 0.4 * $this->getEquilibre() + 0.4 * $this->getStrength() + 0.4 * $this->getVitesse() + $random;
    }
}
