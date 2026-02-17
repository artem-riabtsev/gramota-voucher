<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260217105627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE voucher (id INT AUTO_INCREMENT NOT NULL, journal VARCHAR(255) NOT NULL, full_name VARCHAR(255) NOT NULL, orcid VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, valid_from DATETIME NOT NULL, valid_to DATETIME NOT NULL, created_at DATETIME NOT NULL, uuid CHAR(36) NOT NULL, UNIQUE INDEX UNIQ_1392A5D8D17F50A6 (uuid), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE voucher');
    }
}
