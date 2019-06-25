<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190625151250 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE genre CHANGE description description VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE movie CHANGE director_id director_id INT DEFAULT NULL, CHANGE release_date release_date DATE DEFAULT NULL, CHANGE revenue revenue INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review CHANGE movie_id movie_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE genre CHANGE description description VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE movie CHANGE director_id director_id INT DEFAULT NULL, CHANGE release_date release_date DATE DEFAULT \'NULL\', CHANGE revenue revenue INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review CHANGE movie_id movie_id INT DEFAULT NULL');
    }
}
