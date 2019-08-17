<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190815143505 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (
                                id INT AUTO_INCREMENT NOT NULL,
                                email VARCHAR(180) NOT NULL,
                                roles JSON NOT NULL,
                                password VARCHAR(255) NOT NULL,
                                facebook_id BIGINT NULL,
                                user_name VARCHAR (255) NULL,
                                UNIQUE INDEX UNIQ_8D93D649E7927C74 (email),
                                PRIMARY KEY(id))
                                DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');

        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, season VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE queue (id INT AUTO_INCREMENT NOT NULL, season_id INT NOT NULL, number INT NOT NULL, time_start DATETIME NOT NULL, time_end DATETIME NOT NULL, INDEX IDX_7FFD7F634EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `match` (id INT AUTO_INCREMENT NOT NULL, queue_id INT NOT NULL, goals_home INT DEFAULT NULL, goals_away INT DEFAULT NULL, INDEX IDX_7A5BC505477B5BAE (queue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE queue ADD CONSTRAINT FK_7FFD7F634EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE `match` ADD CONSTRAINT FK_7A5BC505477B5BAE FOREIGN KEY (queue_id) REFERENCES queue (id)');
        $this->addSql('ALTER TABLE user CHANGE user_name user_name VARCHAR(255) NOT NULL');



    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');

        $this->addSql('ALTER TABLE queue DROP FOREIGN KEY FK_7FFD7F634EC001D1');
        $this->addSql('ALTER TABLE `match` DROP FOREIGN KEY FK_7A5BC505477B5BAE');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE queue');
        $this->addSql('DROP TABLE `match`');
        $this->addSql('ALTER TABLE user CHANGE user_name user_name VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
