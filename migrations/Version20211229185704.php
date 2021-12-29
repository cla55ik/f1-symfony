<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211229185704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE comand_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE comand (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE pilot ADD comand_id INT NOT NULL');
        $this->addSql('ALTER TABLE pilot ADD CONSTRAINT FK_8D1E5F52A8A35F58 FOREIGN KEY (comand_id) REFERENCES comand (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8D1E5F52A8A35F58 ON pilot (comand_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pilot DROP CONSTRAINT FK_8D1E5F52A8A35F58');
        $this->addSql('DROP SEQUENCE comand_id_seq CASCADE');
        $this->addSql('DROP TABLE comand');
        $this->addSql('DROP INDEX IDX_8D1E5F52A8A35F58');
        $this->addSql('ALTER TABLE pilot DROP comand_id');
    }
}
