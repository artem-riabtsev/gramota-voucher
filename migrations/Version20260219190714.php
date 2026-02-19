<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260219190714 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_1392A5D8D17F50A6 ON voucher');
        $this->addSql('ALTER TABLE voucher MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE voucher DROP id, CHANGE uuid uuid BINARY(16) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (uuid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voucher ADD id INT AUTO_INCREMENT NOT NULL, CHANGE uuid uuid CHAR(36) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1392A5D8D17F50A6 ON voucher (uuid)');
    }
}
