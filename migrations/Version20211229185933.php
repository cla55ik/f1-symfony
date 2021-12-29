<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211229185933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE country_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE country (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE comand ADD country_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comand ADD CONSTRAINT FK_1538516AF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1538516AF92F3E70 ON comand (country_id)');
        $this->addSql('ALTER TABLE pilot ADD country_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pilot ADD CONSTRAINT FK_8D1E5F52F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8D1E5F52F92F3E70 ON pilot (country_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comand DROP CONSTRAINT FK_1538516AF92F3E70');
        $this->addSql('ALTER TABLE pilot DROP CONSTRAINT FK_8D1E5F52F92F3E70');
        $this->addSql('DROP SEQUENCE country_id_seq CASCADE');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP INDEX IDX_8D1E5F52F92F3E70');
        $this->addSql('ALTER TABLE pilot DROP country_id');
        $this->addSql('DROP INDEX IDX_1538516AF92F3E70');
        $this->addSql('ALTER TABLE comand DROP country_id');
    }
}
