<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240703150126 extends AbstractMigration
{
   

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
       // $this->addSql('ALTER TABLE animal DROP image_name, CHANGE image image VARCHAR(255) NOT NULL');
        $this->addsql('ALTER TABLE animal ADD image VARCHAR(255)');
    }

    // public function down(Schema $schema): void
    // {
    //     // this down() migration is auto-generated, please modify it to your needs
    //     //$this->addSql('ALTER TABLE animal ADD image_name VARCHAR(255) NOT NULL, CHANGE image image VARCHAR(255) DEFAULT NULL');
       
    // }
}
