<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220411095400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE gladiateur (id INT AUTO_INCREMENT NOT NULL, ludi_id INT NOT NULL, nom VARCHAR(255) NOT NULL, adresse DOUBLE PRECISION NOT NULL, strength DOUBLE PRECISION NOT NULL, equilibre DOUBLE PRECISION NOT NULL, vitesse DOUBLE PRECISION NOT NULL, strategie DOUBLE PRECISION NOT NULL, INDEX IDX_C4F56ED0390910BB (ludi_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE gladiateur ADD CONSTRAINT FK_C4F56ED0390910BB FOREIGN KEY (ludi_id) REFERENCES ludi (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE gladiateur');
    }
}
