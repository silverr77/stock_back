<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220125223746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, phone VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_clients (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, produit_id INT NOT NULL, qnt INT NOT NULL, prix_vente DOUBLE PRECISION NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', total_a_payer DOUBLE PRECISION NOT NULL, etat TINYINT(1) NOT NULL, INDEX IDX_F6735CD419EB6921 (client_id), INDEX IDX_F6735CD4F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_fournisseurs (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT NOT NULL, produit_id INT NOT NULL, qnt INT NOT NULL, prix_achat DOUBLE PRECISION NOT NULL, total_a_payer DOUBLE PRECISION NOT NULL, etat TINYINT(1) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E913A00A670C757F (fournisseur_id), INDEX IDX_E913A00AF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture_commande_clients (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, montant_payer DOUBLE PRECISION NOT NULL, type_paiement VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6B695C7382EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture_commande_fournisseurs (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, montant_payer DOUBLE PRECISION NOT NULL, type_paiement VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FE4A317D82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseurs (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, label VARCHAR(255) NOT NULL, prix_achat DOUBLE PRECISION NOT NULL, stock INT NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', prix_vente DOUBLE PRECISION NOT NULL, INDEX IDX_29A5EC27BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_defectueuse (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, qnt INT NOT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9F9ED6FF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_clients ADD CONSTRAINT FK_F6735CD419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE commande_clients ADD CONSTRAINT FK_F6735CD4F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE commande_fournisseurs ADD CONSTRAINT FK_E913A00A670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseurs (id)');
        $this->addSql('ALTER TABLE commande_fournisseurs ADD CONSTRAINT FK_E913A00AF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE facture_commande_clients ADD CONSTRAINT FK_6B695C7382EA2E54 FOREIGN KEY (commande_id) REFERENCES commande_clients (id)');
        $this->addSql('ALTER TABLE facture_commande_fournisseurs ADD CONSTRAINT FK_FE4A317D82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande_fournisseurs (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE produit_defectueuse ADD CONSTRAINT FK_9F9ED6FF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27BCF5E72D');
        $this->addSql('ALTER TABLE commande_clients DROP FOREIGN KEY FK_F6735CD419EB6921');
        $this->addSql('ALTER TABLE facture_commande_clients DROP FOREIGN KEY FK_6B695C7382EA2E54');
        $this->addSql('ALTER TABLE facture_commande_fournisseurs DROP FOREIGN KEY FK_FE4A317D82EA2E54');
        $this->addSql('ALTER TABLE commande_fournisseurs DROP FOREIGN KEY FK_E913A00A670C757F');
        $this->addSql('ALTER TABLE commande_clients DROP FOREIGN KEY FK_F6735CD4F347EFB');
        $this->addSql('ALTER TABLE commande_fournisseurs DROP FOREIGN KEY FK_E913A00AF347EFB');
        $this->addSql('ALTER TABLE produit_defectueuse DROP FOREIGN KEY FK_9F9ED6FF347EFB');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande_clients');
        $this->addSql('DROP TABLE commande_fournisseurs');
        $this->addSql('DROP TABLE facture_commande_clients');
        $this->addSql('DROP TABLE facture_commande_fournisseurs');
        $this->addSql('DROP TABLE fournisseurs');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE produit_defectueuse');
    }
}
