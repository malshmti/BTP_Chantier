<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211112073510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE approbation_tache (id INT AUTO_INCREMENT NOT NULL, prestataire_id INT NOT NULL, tache_id INT NOT NULL, UNIQUE INDEX UNIQ_E67A3D51BE3DB2B7 (prestataire_id), UNIQUE INDEX UNIQ_E67A3D51D2235D39 (tache_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chantier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, quantite INT NOT NULL, date_facture DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE materiau (id INT AUTO_INCREMENT NOT NULL, commande_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prix_kg INT NOT NULL, INDEX IDX_18D5DD5582EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phase (id INT AUTO_INCREMENT NOT NULL, chantier_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_B1BDD6CBD0C0049D (chantier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tache (id INT AUTO_INCREMENT NOT NULL, prestataire_id INT DEFAULT NULL, phase_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, duree INT NOT NULL, INDEX IDX_93872075BE3DB2B7 (prestataire_id), INDEX IDX_9387207599091188 (phase_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE approbation_tache ADD CONSTRAINT FK_E67A3D51BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE approbation_tache ADD CONSTRAINT FK_E67A3D51D2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE materiau ADD CONSTRAINT FK_18D5DD5582EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE phase ADD CONSTRAINT FK_B1BDD6CBD0C0049D FOREIGN KEY (chantier_id) REFERENCES chantier (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075BE3DB2B7 FOREIGN KEY (prestataire_id) REFERENCES prestataire (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_9387207599091188 FOREIGN KEY (phase_id) REFERENCES phase (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE phase DROP FOREIGN KEY FK_B1BDD6CBD0C0049D');
        $this->addSql('ALTER TABLE materiau DROP FOREIGN KEY FK_18D5DD5582EA2E54');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_9387207599091188');
        $this->addSql('ALTER TABLE approbation_tache DROP FOREIGN KEY FK_E67A3D51BE3DB2B7');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075BE3DB2B7');
        $this->addSql('ALTER TABLE approbation_tache DROP FOREIGN KEY FK_E67A3D51D2235D39');
        $this->addSql('DROP TABLE approbation_tache');
        $this->addSql('DROP TABLE chantier');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE materiau');
        $this->addSql('DROP TABLE phase');
        $this->addSql('DROP TABLE prestataire');
        $this->addSql('DROP TABLE tache');
    }
}
