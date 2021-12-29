<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211229190841 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE statistics_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE statistics (id INT NOT NULL, pilot_id INT DEFAULT NULL, race_start INT DEFAULT NULL, race_finish INT DEFAULT NULL, poul_position INT DEFAULT NULL, start_position INT DEFAULT NULL, finish_position INT DEFAULT NULL, points INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E2D38B22CE55439B ON statistics (pilot_id)');
        $this->addSql('ALTER TABLE statistics ADD CONSTRAINT FK_E2D38B22CE55439B FOREIGN KEY (pilot_id) REFERENCES pilot (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE statistics_id_seq CASCADE');
        $this->addSql('DROP TABLE statistics');
    }
}
