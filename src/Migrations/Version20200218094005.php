<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200218094005 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE event_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE associassion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE partner_offre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE partner_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE event_description_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE event (id INT NOT NULL, name VARCHAR(255) NOT NULL, sub_title VARCHAR(255) DEFAULT NULL, emplacement VARCHAR(255) DEFAULT NULL, price VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE associassion (id INT NOT NULL, name VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, link VARCHAR(255) DEFAULT NULL, sub_title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE partner_offre (id INT NOT NULL, partner_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, sub_title VARCHAR(255) DEFAULT NULL, price NUMERIC(10, 2) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BCBA2A0A9393F8FE ON partner_offre (partner_id)');
        $this->addSql('CREATE TABLE partner (id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE event_description (id INT NOT NULL, title VARCHAR(255) NOT NULL, sub_title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE partner_offre ADD CONSTRAINT FK_BCBA2A0A9393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE partner_offre DROP CONSTRAINT FK_BCBA2A0A9393F8FE');
        $this->addSql('DROP SEQUENCE event_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE associassion_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE partner_offre_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE partner_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE event_description_id_seq CASCADE');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE associassion');
        $this->addSql('DROP TABLE partner_offre');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE event_description');
    }
}
