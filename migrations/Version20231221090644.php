<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231221090644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant_poste DROP FOREIGN KEY FK_3B323B7DDEAB1A3');
        $this->addSql('ALTER TABLE etudiant_poste DROP FOREIGN KEY FK_3B323B7A0905086');
        $this->addSql('ALTER TABLE etudiant_poste ADD id INT AUTO_INCREMENT NOT NULL, ADD cv LONGBLOB NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE etudiant_poste ADD CONSTRAINT FK_3B323B7DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id)');
        $this->addSql('ALTER TABLE etudiant_poste ADD CONSTRAINT FK_3B323B7A0905086 FOREIGN KEY (poste_id) REFERENCES poste (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant_poste MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE etudiant_poste DROP FOREIGN KEY FK_3B323B7DDEAB1A3');
        $this->addSql('ALTER TABLE etudiant_poste DROP FOREIGN KEY FK_3B323B7A0905086');
        $this->addSql('DROP INDEX `PRIMARY` ON etudiant_poste');
        $this->addSql('ALTER TABLE etudiant_poste DROP id, DROP cv');
        $this->addSql('ALTER TABLE etudiant_poste ADD CONSTRAINT FK_3B323B7DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etudiant_poste ADD CONSTRAINT FK_3B323B7A0905086 FOREIGN KEY (poste_id) REFERENCES poste (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etudiant_poste ADD PRIMARY KEY (etudiant_id, poste_id)');
    }
}
