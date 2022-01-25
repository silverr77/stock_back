<?php

namespace App\Entity;

use App\Repository\FournisseursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=FournisseursRepository::class)
 * @ApiResource()
 */
class Fournisseurs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity=CommandeFournisseurs::class, mappedBy="fournisseur", orphanRemoval=true)
     */
    private $commandeFournisseurs;

    public function __construct()
    {
        $this->commandeFournisseurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|CommandeFournisseurs[]
     */
    public function getCommandeFournisseurs(): Collection
    {
        return $this->commandeFournisseurs;
    }

    public function addCommandeFournisseur(CommandeFournisseurs $commandeFournisseur): self
    {
        if (!$this->commandeFournisseurs->contains($commandeFournisseur)) {
            $this->commandeFournisseurs[] = $commandeFournisseur;
            $commandeFournisseur->setFournisseur($this);
        }

        return $this;
    }

    public function removeCommandeFournisseur(CommandeFournisseurs $commandeFournisseur): self
    {
        if ($this->commandeFournisseurs->removeElement($commandeFournisseur)) {
            // set the owning side to null (unless already changed)
            if ($commandeFournisseur->getFournisseur() === $this) {
                $commandeFournisseur->setFournisseur(null);
            }
        }

        return $this;
    }

}
