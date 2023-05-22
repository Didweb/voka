<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230522171216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE user (
                            id VARCHAR(255) NOT NULL, 
                            name VARCHAR(150) NOT NULL, 
                            email VARCHAR(150) NOT NULL, 
                            created_at DATETIME NOT NULL, 
                            updated_at DATETIME DEFAULT NULL, 
                            INDEX user_index (id), PRIMARY KEY(id)) 
                            DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;');

        $this->addSql('CREATE TABLE user_training (
                            id VARCHAR(255) NOT NULL, 
                            user_id VARCHAR(255) DEFAULT NULL, 
                            hits INT NOT NULL, failures INT NOT NULL, 
                            overcome TINYINT(1) NOT NULL, 
                            INDEX IDX_359F6E8FA76ED395 (user_id), 
                            INDEX user_trianing_index (id), 
                            PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
