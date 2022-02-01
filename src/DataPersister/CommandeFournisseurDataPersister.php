<?php

// src/DataPersister

namespace App\DataPersister;
use Doctrine\ORM\EntityManagerInterface;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\CommandeFournisseurs;

class CommandeFournisseurDataPersister implements ContextAwareDataPersisterInterface {

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
        return $data instanceof CommandeFournisseurs;
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
        // update stock.
        $produit->setStock($produit_stock + $qnt);
        // update total a payer.
        $data->setTotalAPayer($data->getPrixAchat() * $qnt);
        $produit->setUpdatedAt(new \DateTimeImmutable('now'));
        $this->_entityManager->persist($produit);
        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
    }

    public function remove($data, array $context = []) {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }
}