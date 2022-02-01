<?php

// src/DataPersister

namespace App\DataPersister;
use Doctrine\ORM\EntityManagerInterface;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\FactureCommandeClients;

class FactureClientDataPersister implements ContextAwareDataPersisterInterface {

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
        return $data instanceof FactureCommandeClients;
    }

    public function persist($data, array $context = [])
    {
        $commande = $data->getCommande();
        if ($commande->getEtat()) {
            throw new \Exception(sprintf("la commande est déjà payé."));
        }
        $current_commande_montant_a_payer = $data->getMontantPayer();
        if ($current_commande_montant_a_payer <= 0) {
            throw new \Exception(sprintf("le montant doit être > 0."));
        }
        $total_a_payer = $commande->getTotalAPayer();
        $factures = $commande->getFactureCommandeClients()->getValues();
        $total_factures = $current_commande_montant_a_payer;
        if (!empty($factures)) {
            foreach ($factures as $facture) {
                $total_factures+= $facture->getMontantPayer();
            }
        }

        if ($total_factures >= $total_a_payer) {
            $commande->setEtat(true);
            $commande->setUpdatedAt(new \DateTimeImmutable('now'));
            $this->_entityManager->persist($commande);
        }
        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
    }

    public function remove($data, array $context = []) {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }
}