<?php

namespace App\Entity;

use App\Repository\CommandeFournisseursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=CommandeFournisseursRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @ApiResource()
 */
class CommandeFournisseurs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $qnt;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_achat;

    /**
     * @ORM\ManyToOne(targetEntity=Fournisseurs::class, inversedBy="commandeFournisseurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fournisseur;

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="commandeFournisseurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    /**
     * @ORM\Column(type="float")
     */
    private $total_a_payer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etat;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity=FactureCommandeFournisseurs::class, mappedBy="commande", orphanRemoval=true)
     */
    private $factureCommandeFournisseurs;

    public function __construct()
    {
        $this->factureCommandeFournisseurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQnt(): ?int
    {
        return $this->qnt;
    }

    public function setQnt(int $qnt): self
    {
        $this->qnt = $qnt;

        return $this;
    }

    public function getPrixAchat(): ?float
    {
        return $this->prix_achat;
    }

    public function setPrixAchat(float $prix_achat): self
    {
        $this->prix_achat = $prix_achat;

        return $this;
    }

    public function getFournisseur(): ?Fournisseurs
    {
        return $this->fournisseur;
    }

    public function setFournisseur(?Fournisseurs $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getTotalAPayer(): ?float
    {
        return $this->total_a_payer;
    }

    public function setTotalAPayer(float $total_a_payer): self
    {
        $this->total_a_payer = $total_a_payer;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection|FactureCommandeFournisseurs[]
     */
    public function getFactureCommandeFournisseurs(): Collection
    {
        return $this->factureCommandeFournisseurs;
    }

    public function addFactureCommandeFournisseur(FactureCommandeFournisseurs $factureCommandeFournisseur): self
    {
        if (!$this->factureCommandeFournisseurs->contains($factureCommandeFournisseur)) {
            $this->factureCommandeFournisseurs[] = $factureCommandeFournisseur;
            $factureCommandeFournisseur->setCommande($this);
        }

        return $this;
    }

    public function removeFactureCommandeFournisseur(FactureCommandeFournisseurs $factureCommandeFournisseur): self
    {
        if ($this->factureCommandeFournisseurs->removeElement($factureCommandeFournisseur)) {
            // set the owning side to null (unless already changed)
            if ($factureCommandeFournisseur->getCommande() === $this) {
                $factureCommandeFournisseur->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
    */
    public function updatedTimestamps(): void {
        $this->setUpdatedAt(new \DateTimeImmutable('now'));
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTimeImmutable('now'));
        }
    }
}
