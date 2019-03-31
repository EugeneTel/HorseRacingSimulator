<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190331130440 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE horse (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, speed DOUBLE PRECISION NOT NULL, strength DOUBLE PRECISION NOT NULL, endurance DOUBLE PRECISION NOT NULL, active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_629A2F185E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');

        $this->addSql('INSERT INTO horse (name, speed, strength, endurance, active) VALUES 
            ("Lucky", 8.5, 7.2, 5, 1),
            ("Blazer", 7.5, 8.0, 6, 1),
            ("Franklin", 8, 8.5, 4.5, 1),
            ("Colorado", 5.3, 8.5, 7, 1),
            ("Officer", 6.7, 8.0, 5.3, 1),
            ("Lincoln", 5.8, 9.5, 7.2, 1),
            ("Kentucky", 5.1, 8.5, 8.8, 1),
            ("Skydancer", 9.1, 6.3, 8.1, 1),
            ("Carolina", 8.1, 7.3, 6.1, 1),
            ("Eleanor", 8.6, 7.8, 6.2, 1),
            ("Velvet", 7.6, 7.2, 6.3, 1),
            ("Cherish", 8.0, 7.5, 8.2, 1),
            ("Jupiter", 7.5, 6.2, 5, 1),
            ("Ellie", 7.5, 7.0, 6.3, 1),
            ("Marmalade", 8.5, 7.5, 5.5, 1),
            ("Gypsy", 5.3, 6.5, 7.5, 1),
            ("Magnolia", 7.7, 8.3, 5.3, 1),
            ("Meadow", 8.8, 9.5, 5.2, 1),
            ("Wisteria", 6.1, 7.5, 8.2, 1),
            ("Temperance", 8.3, 7.3, 8.3, 1),
            ("Nicole", 8.6, 7.1, 6.8, 1),
            ("Daisy", 8.1, 7.3, 5.2, 1),
            ("Tank", 7.7, 8.2, 8.1, 1),
            ("Rushmore", 8.3, 7.6, 7.2, 1),
            ("Angus", 8.6, 7.3, 7.2, 1),
            ("Flicka", 7.3, 6.8, 7.2, 1),
            ("Omaha", 8.3, 6.6, 7.9, 1),
            ("Assault", 8.4, 7.1, 6.8, 1),
            ("Apollo", 8.1, 7.3, 7.8, 1)
            ');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE horse');
    }
}
