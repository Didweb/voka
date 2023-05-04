<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230426054934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE category (
                            id VARCHAR(255) NOT NULL, 
                            name VARCHAR(90) NOT NULL, 
                            created_at DATETIME NOT NULL, 
                            updated_at DATETIME DEFAULT NULL, 
                            UNIQUE INDEX UNIQ_64C19C15E237E06 (name), 
                            INDEX name_index (name), 
                            PRIMARY KEY(id)) 
                            DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` 
                            ENGINE = InnoDB;');

        $this->addSql('CREATE TABLE word (
                            id VARCHAR(255) NOT NULL, 
                            category_id VARCHAR(255) DEFAULT NULL, 
                            word VARCHAR(90) NOT NULL, 
                            image VARCHAR(150) DEFAULT NULL, 
                            gender VARCHAR(3) DEFAULT NULL, 
                            level VARCHAR(2) DEFAULT NULL, 
                            created_at DATETIME NOT NULL, 
                            updated_at DATETIME DEFAULT NULL, 
                            UNIQUE INDEX UNIQ_C3F17511C3F17511 (word), 
                            INDEX IDX_C3F1751112469DE2 (category_id), 
                            INDEX word_index (word), PRIMARY KEY(id)) 
                            DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` 
                            ENGINE = InnoDB;');

        $this->addSql('ALTER TABLE word ADD CONSTRAINT FK_C3F1751112469DE2 FOREIGN KEY (category_id) REFERENCES category (id);');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
