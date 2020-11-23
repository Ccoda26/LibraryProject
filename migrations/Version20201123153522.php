<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123153522 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article CHANGE publicationdate publicationdate DATE DEFAULT NULL, CHANGE creationdate creationdate DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE category CHANGE publicationdate publicationdate DATE DEFAULT NULL, CHANGE creationdate creationdate DATE DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article CHANGE publicationdate publicationdate VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE creationdate creationdate VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE category CHANGE publicationdate publicationdate DATETIME DEFAULT NULL, CHANGE creationdate creationdate DATETIME DEFAULT NULL');
    }
}
