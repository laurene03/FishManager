<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251219153354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE binome (id INT AUTO_INCREMENT NOT NULL, etudiant1_id INT DEFAULT NULL, etudiant2_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_152596DE996E3570 (etudiant1_id), UNIQUE INDEX UNIQ_152596DE8BDB9A9E (etudiant2_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE etudiant (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE releve (id INT AUTO_INCREMENT NOT NULL, temperature NUMERIC(3, 1) NOT NULL, co2dissous NUMERIC(4, 2) NOT NULL, p_h4 NUMERIC(3, 1) NOT NULL, g_h NUMERIC(4, 2) NOT NULL, k_h NUMERIC(4, 2) NOT NULL, chlore NUMERIC(3, 2) NOT NULL, nitrite NUMERIC(3, 2) NOT NULL, nitrate NUMERIC(3, 2) NOT NULL, date DATETIME NOT NULL, remarque LONGTEXT DEFAULT NULL, binome_id INT NOT NULL, INDEX IDX_DDABFF838D4924C4 (binome_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE repas (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, binome_id INT NOT NULL, INDEX IDX_A8D351B38D4924C4 (binome_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE binome ADD CONSTRAINT FK_152596DE996E3570 FOREIGN KEY (etudiant1_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE binome ADD CONSTRAINT FK_152596DE8BDB9A9E FOREIGN KEY (etudiant2_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE releve ADD CONSTRAINT FK_DDABFF838D4924C4 FOREIGN KEY (binome_id) REFERENCES binome (id)');
        $this->addSql('ALTER TABLE repas ADD CONSTRAINT FK_A8D351B38D4924C4 FOREIGN KEY (binome_id) REFERENCES binome (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE binome DROP FOREIGN KEY FK_152596DE996E3570');
        $this->addSql('ALTER TABLE binome DROP FOREIGN KEY FK_152596DE8BDB9A9E');
        $this->addSql('ALTER TABLE releve DROP FOREIGN KEY FK_DDABFF838D4924C4');
        $this->addSql('ALTER TABLE repas DROP FOREIGN KEY FK_A8D351B38D4924C4');
        $this->addSql('DROP TABLE binome');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE releve');
        $this->addSql('DROP TABLE repas');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
