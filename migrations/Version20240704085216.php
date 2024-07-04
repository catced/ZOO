<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704085216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD image_name VARCHAR(255) DEFAULT NULL, DROP imagefile, DROP imagename, CHANGE consultation consultation INT NOT NULL');
     
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD imagename VARCHAR(255) DEFAULT NULL, CHANGE consultation consultation INT DEFAULT NULL, CHANGE image_name imagefile VARCHAR(255) DEFAULT NULL');

    }
}
