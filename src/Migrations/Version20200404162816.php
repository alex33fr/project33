<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200404162816 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, second_name VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category CHANGE tree_root tree_root INT DEFAULT NULL, CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE image_name image_name VARCHAR(255) DEFAULT NULL, CHANGE image_size image_size INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE image_name image_name VARCHAR(255) DEFAULT NULL, CHANGE image_size image_size INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE model model VARCHAR(255) DEFAULT NULL, CHANGE color color VARCHAR(255) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE category CHANGE tree_root tree_root INT DEFAULT NULL, CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE image_name image_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE image_size image_size INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\', CHANGE created_at created_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE product CHANGE image_name image_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE image_size image_size INT DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\', CHANGE model model VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE color color VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE created_at created_at DATETIME DEFAULT \'NULL\'');
    }
}
