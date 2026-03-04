<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260304103544 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE voucher (uuid BINARY(16) NOT NULL, full_name VARCHAR(255) NOT NULL, orcid VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, discount INT NOT NULL, valid_from DATETIME NOT NULL, valid_to DATETIME NOT NULL, created_at DATETIME NOT NULL, voucher_type_id INT NOT NULL, INDEX IDX_1392A5D8681A694 (voucher_type_id), PRIMARY KEY (uuid)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE voucher_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, default_discount INT NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE voucher ADD CONSTRAINT FK_1392A5D8681A694 FOREIGN KEY (voucher_type_id) REFERENCES voucher_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voucher DROP FOREIGN KEY FK_1392A5D8681A694');
        $this->addSql('DROP TABLE voucher');
        $this->addSql('DROP TABLE voucher_type');
    }
}
