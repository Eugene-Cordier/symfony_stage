<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218142513 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE administrateur ADD email VARCHAR(180) NOT NULL');
        $this->addSql('ALTER TABLE etudiant CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_717E22E3E7927C74 ON etudiant (email)');
        $this->addSql('ALTER TABLE recruteur ADD email VARCHAR(180) DEFAULT NULL, ADD telephone VARCHAR(10) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE administrateur DROP email');
        $this->addSql('DROP INDEX UNIQ_717E22E3E7927C74 ON etudiant');
        $this->addSql('ALTER TABLE etudiant CHANGE email email VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE recruteur DROP email, DROP telephone');
    }
}
