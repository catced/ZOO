<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240704143917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP file, CHANGE consultation consultation INT NOT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE size size INT DEFAULT NULL');
     
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD file VARCHAR(255) DEFAULT NULL, DROP updated_at, CHANGE consultation consultation INT DEFAULT NULL, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE size size VARCHAR(255) DEFAULT NULL');
       
    }
}
