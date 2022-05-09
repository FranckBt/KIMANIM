<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509095421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activities (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', start_on DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', adress LONGTEXT NOT NULL, city VARCHAR(255) NOT NULL, zipcode VARCHAR(255) NOT NULL, status VARCHAR(20) NOT NULL, min_participants INT NOT NULL, title VARCHAR(255) NOT NULL, illustration VARCHAR(255) DEFAULT NULL, INDEX IDX_B5F1AFE5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', text LONGTEXT DEFAULT NULL, rate INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE childrens (id INT AUTO_INCREMENT NOT NULL, parent_id INT NOT NULL, name VARCHAR(255) NOT NULL, additional LONGTEXT DEFAULT NULL, age_range VARCHAR(20) NOT NULL, INDEX IDX_301B0228727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, surname VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', name VARCHAR(255) DEFAULT NULL, actif TINYINT(1) DEFAULT NULL, validate TINYINT(1) DEFAULT NULL, phone VARCHAR(30) DEFAULT NULL, alias VARCHAR(255) DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, token_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', avatar VARCHAR(255) DEFAULT NULL, bio LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activities ADD CONSTRAINT FK_B5F1AFE5A76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE childrens ADD CONSTRAINT FK_301B0228727ACA70 FOREIGN KEY (parent_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activities DROP FOREIGN KEY FK_B5F1AFE5A76ED395');
        $this->addSql('ALTER TABLE childrens DROP FOREIGN KEY FK_301B0228727ACA70');
        $this->addSql('DROP TABLE activities');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE childrens');
        $this->addSql('DROP TABLE users');
    }
}
