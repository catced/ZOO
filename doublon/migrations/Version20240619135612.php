<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240619135612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nourriture_animal (nourriture_id INT NOT NULL, animal_id INT NOT NULL, INDEX IDX_B3D09C298BD5834 (nourriture_id), INDEX IDX_B3D09C28E962C16 (animal_id), PRIMARY KEY(nourriture_id, animal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE nourriture_animal ADD CONSTRAINT FK_B3D09C298BD5834 FOREIGN KEY (nourriture_id) REFERENCES nourriture (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nourriture_animal ADD CONSTRAINT FK_B3D09C28E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE nourriture_animal DROP FOREIGN KEY FK_B3D09C298BD5834');
        $this->addSql('ALTER TABLE nourriture_animal DROP FOREIGN KEY FK_B3D09C28E962C16');
        $this->addSql('DROP TABLE nourriture_animal');
    }
}
