<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @ApiResource()
 */
class Produit
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
     * @ORM\Column(type="float")
     */
    private $prix_achat;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="produits")
     */
    private $categorie;

    /**
     * @ORM\Column(type="float")
     */
    private $prix_vente;

    /**
     * @ORM\OneToMany(targetEntity=CommandeClients::class, mappedBy="produit")
     */
    private $commandeClients;

    /**
     * @ORM\OneToMany(targetEntity=ProduitDefectueuse::class, mappedBy="produit", orphanRemoval=true)
     */
    private $produitDefectueuses;

    /**
     * @ORM\OneToMany(targetEntity=CommandeFournisseurs::class, mappedBy="produit", orphanRemoval=true)
     */
    private $commandeFournisseurs;

    public function __construct()
    {
        $this->commandeClients = new ArrayCollection();
        $this->produitDefectueuses = new ArrayCollection();
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

    public function getPrixAchat(): ?float
    {
        return $this->prix_achat;
    }

    public function setPrixAchat(float $prix_achat): self
    {
        $this->prix_achat = $prix_achat;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

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

    public function getPrixVente(): ?float
    {
        return $this->prix_vente;
    }

    public function setPrixVente(float $prix_vente): self
    {
        $this->prix_vente = $prix_vente;

        return $this;
    }

    /**
     * @return Collection|CommandeClients[]
     */
    public function getCommandeClients(): Collection
    {
        return $this->commandeClients;
    }

    public function addCommandeClient(CommandeClients $commandeClient): self
    {
        if (!$this->commandeClients->contains($commandeClient)) {
            $this->commandeClients[] = $commandeClient;
            $commandeClient->setProduit($this);
        }

        return $this;
    }

    public function removeCommandeClient(CommandeClients $commandeClient): self
    {
        if ($this->commandeClients->removeElement($commandeClient)) {
            // set the owning side to null (unless already changed)
            if ($commandeClient->getProduit() === $this) {
                $commandeClient->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ProduitDefectueuse[]
     */
    public function getProduitDefectueuses(): Collection
    {
        return $this->produitDefectueuses;
    }

    public function addProduitDefectueus(ProduitDefectueuse $produitDefectueus): self
    {
        if (!$this->produitDefectueuses->contains($produitDefectueus)) {
            $this->produitDefectueuses[] = $produitDefectueus;
            $produitDefectueus->setProduit($this);
        }

        return $this;
    }

    public function removeProduitDefectueus(ProduitDefectueuse $produitDefectueus): self
    {
        if ($this->produitDefectueuses->removeElement($produitDefectueus)) {
            // set the owning side to null (unless already changed)
            if ($produitDefectueus->getProduit() === $this) {
                $produitDefectueus->setProduit(null);
            }
        }

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
            $commandeFournisseur->setProduit($this);
        }

        return $this;
    }

    public function removeCommandeFournisseur(CommandeFournisseurs $commandeFournisseur): self
    {
        if ($this->commandeFournisseurs->removeElement($commandeFournisseur)) {
            // set the owning side to null (unless already changed)
            if ($commandeFournisseur->getProduit() === $this) {
                $commandeFournisseur->setProduit(null);
            }
        }

        return $this;
    }
}
