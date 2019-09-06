<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190819165701 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE match_types (id INT AUTO_INCREMENT NOT NULL, match_game_id INT NOT NULL, goals_home INT NOT NULL, goals_away INT NOT NULL, INDEX IDX_E75AF6919329866A (match_game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE match_types ADD CONSTRAINT FK_E75AF6919329866A FOREIGN KEY (match_game_id) REFERENCES match_game (id)');
        $this->addSql('ALTER TABLE league_table RENAME INDEX fk_f6298f46f0e45ba9 TO IDX_81C46070F0E45BA9');
        $this->addSql('ALTER TABLE match_game RENAME INDEX idx_7a5bc5057ffd7f63 TO IDX_424480FE7FFD7F63');
        $this->addSql('ALTER TABLE match_game RENAME INDEX fk_7a5bc505cf6600e TO IDX_424480FECF6600E');
        $this->addSql('ALTER TABLE match_game RENAME INDEX fk_7a5bc50571d60cd0 TO IDX_424480FE71D60CD0');
        $this->addSql('ALTER TABLE match_game RENAME INDEX fk_7a5bc505a65fa2d1 TO IDX_424480FEA65FA2D1');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE match_types');
        $this->addSql('ALTER TABLE league_table RENAME INDEX idx_81c46070f0e45ba9 TO FK_F6298F46F0E45BA9');
        $this->addSql('ALTER TABLE match_game RENAME INDEX idx_424480fecf6600e TO FK_7A5BC505CF6600E');
        $this->addSql('ALTER TABLE match_game RENAME INDEX idx_424480fea65fa2d1 TO FK_7A5BC505A65FA2D1');
        $this->addSql('ALTER TABLE match_game RENAME INDEX idx_424480fe71d60cd0 TO FK_7A5BC50571D60CD0');
        $this->addSql('ALTER TABLE match_game RENAME INDEX idx_424480fe7ffd7f63 TO IDX_7A5BC5057FFD7F63');
    }
}
