<?php

namespace App\Entity;

use App\Repository\FactureCommandeFournisseursRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Entity(repositoryClass=FactureCommandeFournisseursRepository::class)
 * @ORM\HasLifecycleCallbacks
 * @ApiResource()
 */
class FactureCommandeFournisseurs
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $montant_payer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_paiement;

    /**
     * @ORM\ManyToOne(targetEntity=CommandeFournisseurs::class, inversedBy="factureCommandeFournisseurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $commande;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantPayer(): ?float
    {
        return $this->montant_payer;
    }

    public function setMontantPayer(float $montant_payer): self
    {
        $this->montant_payer = $montant_payer;

        return $this;
    }

    public function getTypePaiement(): ?string
    {
        return $this->type_paiement;
    }

    public function setTypePaiement(string $type_paiement): self
    {
        $this->type_paiement = $type_paiement;

        return $this;
    }

    public function getCommande(): ?CommandeFournisseurs
    {
        return $this->commande;
    }

    public function setCommande(?CommandeFournisseurs $commande): self
    {
        $this->commande = $commande;

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
}
