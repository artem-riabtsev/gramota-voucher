<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260324144059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE IF EXISTS voucher');
        $this->addSql('DROP TABLE IF EXISTS voucher_type');
        $this->addSql('CREATE TABLE voucher (uuid BINARY(16) NOT NULL, full_name VARCHAR(255) NOT NULL, orcid VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, redeemed TINYINT NOT NULL, active_from DATETIME NOT NULL, active_to DATETIME NOT NULL, template_uuid BINARY(16) NOT NULL, INDEX IDX_1392A5D84B17ACB (template_uuid), PRIMARY KEY (uuid)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE voucher ADD CONSTRAINT FK_1392A5D84B17ACB FOREIGN KEY (template_uuid) REFERENCES voucher_template (uuid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voucher DROP FOREIGN KEY FK_1392A5D84B17ACB');
        $this->addSql('DROP TABLE voucher');
    }
}
