<?php

// src/DataPersister

namespace App\DataPersister;
use Doctrine\ORM\EntityManagerInterface;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\CommandeClients;

class CommandeClientDataPersister implements ContextAwareDataPersisterInterface {

    /**
     * @var EntityManagerInterface
     */
    private $_entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->_entityManager = $entityManager;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof CommandeClients;
    }

    public function persist($data, array $context = [])
    {
        // TODO: Implement persist() method.
        $qnt = $data->getQnt();
        if ($qnt <= 0) {
            throw new \Exception(sprintf("la quantité doit être > 1"));
        }
        $produit = $data->getProduit();
        $produit_stock = $produit->getStock();
        $stock_restant = $produit_stock - $qnt;
        if ($stock_restant < 0) {
            throw new \Exception(sprintf("la quantité du produit spécifié n'est pas disponible."));
        }
        else {
            // update stock.
            $produit->setStock($stock_restant);
            // update prix vente.
            $data->setPrixVente($produit->getPrixVente());
            // update total a payer.
            $data->setTotalAPayer($produit->getPrixVente() * $qnt);
            $produit->setUpdatedAt(new \DateTimeImmutable('now'));
            $this->_entityManager->persist($produit);
            $this->_entityManager->persist($data);
            $this->_entityManager->flush();
        }
    }

    public function remove($data, array $context = []) {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }
}