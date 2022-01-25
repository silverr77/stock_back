<?php

namespace App\Entity;

use App\Repository\CommandeClientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=CommandeClientsRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @ApiResource()
 */
class CommandeClients
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
    private $prix_vente;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="commandeClients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="commandeClients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updated_at;

    /**
     * @ORM\OneToMany(targetEntity=FactureCommandeClients::class, mappedBy="commande", orphanRemoval=true)
     */
    private $factureCommandeClients;

    /**
     * @ORM\Column(type="float")
     */
    private $total_a_payer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $etat;

    public function __construct()
    {
        $this->factureCommandeClients = new ArrayCollection();
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

    public function getPrixVente(): ?float
    {
        return $this->prix_vente;
    }

    public function setPrixVente(float $prix_vente): self
    {
        $this->prix_vente = $prix_vente;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

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
     * @ORM\PrePersist
     * @ORM\PreUpdate
    */
    public function updatedTimestamps(): void {
        $this->setUpdatedAt(new \DateTimeImmutable('now'));
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTimeImmutable('now'));
        }
    }

    /**
     * @return Collection|FactureCommandeClients[]
     */
    public function getFactureCommandeClients(): Collection
    {
        return $this->factureCommandeClients;
    }

    public function addFactureCommandeClient(FactureCommandeClients $factureCommandeClient): self
    {
        if (!$this->factureCommandeClients->contains($factureCommandeClient)) {
            $this->factureCommandeClients[] = $factureCommandeClient;
            $factureCommandeClient->setCommande($this);
        }

        return $this;
    }

    public function removeFactureCommandeClient(FactureCommandeClients $factureCommandeClient): self
    {
        if ($this->factureCommandeClients->removeElement($factureCommandeClient)) {
            // set the owning side to null (unless already changed)
            if ($factureCommandeClient->getCommande() === $this) {
                $factureCommandeClient->setCommande(null);
            }
        }

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

}
