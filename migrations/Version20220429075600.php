<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220429075600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activities (id INT AUTO_INCREMENT NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', start_on DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', adress LONGTEXT NOT NULL, city VARCHAR(255) NOT NULL, zipcode INT NOT NULL, status VARCHAR(20) NOT NULL, min_participants INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', text LONGTEXT DEFAULT NULL, rate INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE childrens (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, additional LONGTEXT DEFAULT NULL, age_range VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, surname VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', name VARCHAR(255) DEFAULT NULL, actif TINYINT(1) DEFAULT NULL, validate TINYINT(1) DEFAULT NULL, phone VARCHAR(30) DEFAULT NULL, alias VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, token_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', avatar VARCHAR(255) DEFAULT NULL, bio LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE activities');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE childrens');
        $this->addSql('DROP TABLE users');
    }
}
