<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523080645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email);');
        $this->addSql('ALTER TABLE user_training CHANGE id id VARCHAR(255) NOT NULL, CHANGE user_id user_id VARCHAR(255) DEFAULT NULL;');
        $this->addSql('ALTER TABLE user_training ADD CONSTRAINT FK_359F6E8FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id);');
        $this->addSql('ALTER TABLE messenger_messages CHANGE delivered_at delivered_at DATETIME DEFAULT NULL;');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
