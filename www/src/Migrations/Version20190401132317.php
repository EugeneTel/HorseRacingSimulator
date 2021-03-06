<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190401132317 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE race (id INT AUTO_INCREMENT NOT NULL, leader_id INT DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, distance INT NOT NULL, best_time INT NOT NULL, cur_time INT NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_DA6FBBAF73154ED4 (leader_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, race_id INT NOT NULL, horse_id INT NOT NULL, distance DOUBLE PRECISION NOT NULL, time INT NOT NULL, position SMALLINT NOT NULL, active TINYINT(1) NOT NULL, INDEX IDX_D79F6B116E59D40D (race_id), INDEX IDX_D79F6B1176B275AD (horse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE race ADD CONSTRAINT FK_DA6FBBAF73154ED4 FOREIGN KEY (leader_id) REFERENCES participant (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B116E59D40D FOREIGN KEY (race_id) REFERENCES race (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B1176B275AD FOREIGN KEY (horse_id) REFERENCES horse (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B1176B275AD');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B116E59D40D');
        $this->addSql('ALTER TABLE race DROP FOREIGN KEY FK_DA6FBBAF73154ED4');
        $this->addSql('DROP TABLE horse');
        $this->addSql('DROP TABLE race');
        $this->addSql('DROP TABLE participant');
    }
}
