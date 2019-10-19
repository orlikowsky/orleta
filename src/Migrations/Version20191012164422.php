<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191012164422 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE match_types ADD winner INT DEFAULT NULL');
        $this->addSql('ALTER TABLE match_types ADD CONSTRAINT FK_E75AF691CF6600E FOREIGN KEY (winner) REFERENCES league_table (id)');
        $this->addSql('CREATE INDEX IDX_E75AF691CF6600E ON match_types (winner)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE match_types DROP FOREIGN KEY FK_E75AF691CF6600E');
        $this->addSql('DROP INDEX IDX_E75AF691CF6600E ON match_types');
        $this->addSql('ALTER TABLE match_types DROP winner');
    }
}
