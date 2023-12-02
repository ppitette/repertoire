<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231130181519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE artiste_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE chant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE editeur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE secli_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE artiste (id INT NOT NULL, civilite VARCHAR(10) DEFAULT NULL, firstname VARCHAR(50) DEFAULT NULL, lastname VARCHAR(50) NOT NULL, date_naiss VARCHAR(10) DEFAULT NULL, date_deces VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE chant (id INT NOT NULL, editeur_id INT DEFAULT NULL, cote_edit VARCHAR(25) DEFAULT NULL, source VARCHAR(255) DEFAULT NULL, secli INT DEFAULT NULL, ordinaire BOOLEAN NOT NULL, texte TEXT DEFAULT NULL, titre VARCHAR(255) NOT NULL, annee INT DEFAULT NULL, cote VARCHAR(25) DEFAULT NULL, cote_new VARCHAR(25) DEFAULT NULL, snpls VARCHAR(25) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_32177773375BD21 ON chant (editeur_id)');
        $this->addSql('CREATE TABLE chants_auteurs (chant_id INT NOT NULL, artiste_id INT NOT NULL, PRIMARY KEY(chant_id, artiste_id))');
        $this->addSql('CREATE INDEX IDX_8E9377931BE84489 ON chants_auteurs (chant_id)');
        $this->addSql('CREATE INDEX IDX_8E93779321D25844 ON chants_auteurs (artiste_id)');
        $this->addSql('CREATE TABLE chants_compositeurs (chant_id INT NOT NULL, artiste_id INT NOT NULL, PRIMARY KEY(chant_id, artiste_id))');
        $this->addSql('CREATE INDEX IDX_E63F9851BE84489 ON chants_compositeurs (chant_id)');
        $this->addSql('CREATE INDEX IDX_E63F98521D25844 ON chants_compositeurs (artiste_id)');
        $this->addSql('CREATE TABLE editeur (id INT NOT NULL, lib_secli VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, adresse TEXT DEFAULT NULL, telephone VARCHAR(20) DEFAULT NULL, telecopie VARCHAR(20) DEFAULT NULL, courriel VARCHAR(255) DEFAULT NULL, site VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE secli (id INT NOT NULL, auteur VARCHAR(255) DEFAULT NULL, compositeur VARCHAR(255) DEFAULT NULL, editeur VARCHAR(255) DEFAULT NULL, fiche INT NOT NULL, importe BOOLEAN NOT NULL, titre VARCHAR(255) NOT NULL, annee INT DEFAULT NULL, cote VARCHAR(25) DEFAULT NULL, cote_new VARCHAR(25) DEFAULT NULL, snpls VARCHAR(25) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE chant ADD CONSTRAINT FK_32177773375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chants_auteurs ADD CONSTRAINT FK_8E9377931BE84489 FOREIGN KEY (chant_id) REFERENCES chant (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chants_auteurs ADD CONSTRAINT FK_8E93779321D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chants_compositeurs ADD CONSTRAINT FK_E63F9851BE84489 FOREIGN KEY (chant_id) REFERENCES chant (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chants_compositeurs ADD CONSTRAINT FK_E63F98521D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE artiste_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE chant_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE editeur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE secli_id_seq CASCADE');
        $this->addSql('ALTER TABLE chant DROP CONSTRAINT FK_32177773375BD21');
        $this->addSql('ALTER TABLE chants_auteurs DROP CONSTRAINT FK_8E9377931BE84489');
        $this->addSql('ALTER TABLE chants_auteurs DROP CONSTRAINT FK_8E93779321D25844');
        $this->addSql('ALTER TABLE chants_compositeurs DROP CONSTRAINT FK_E63F9851BE84489');
        $this->addSql('ALTER TABLE chants_compositeurs DROP CONSTRAINT FK_E63F98521D25844');
        $this->addSql('DROP TABLE artiste');
        $this->addSql('DROP TABLE chant');
        $this->addSql('DROP TABLE chants_auteurs');
        $this->addSql('DROP TABLE chants_compositeurs');
        $this->addSql('DROP TABLE editeur');
        $this->addSql('DROP TABLE secli');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
