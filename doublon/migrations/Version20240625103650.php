<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240625103650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nourriture DROP FOREIGN KEY FK_7447E6138E962C16');
        $this->addSql('DROP INDEX IDX_7447E6138E962C16 ON nourriture');
        $this->addSql('ALTER TABLE nourriture DROP animal_id');
        $this->addSql('ALTER TABLE rapport_veto ADD nourriture_id INT NOT NULL, CHANGE commentaire detail_etat_animal LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE rapport_veto ADD CONSTRAINT FK_EACE84D998BD5834 FOREIGN KEY (nourriture_id) REFERENCES nourriture (id)');
        $this->addSql('CREATE INDEX IDX_EACE84D998BD5834 ON rapport_veto (nourriture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nourriture ADD animal_id INT NOT NULL');
        $this->addSql('ALTER TABLE nourriture ADD CONSTRAINT FK_7447E6138E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('CREATE INDEX IDX_7447E6138E962C16 ON nourriture (animal_id)');
        $this->addSql('ALTER TABLE rapport_veto DROP FOREIGN KEY FK_EACE84D998BD5834');
        $this->addSql('DROP INDEX IDX_EACE84D998BD5834 ON rapport_veto');
        $this->addSql('ALTER TABLE rapport_veto DROP nourriture_id, CHANGE detail_etat_animal commentaire LONGTEXT NOT NULL');
    }
}
