<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200331171152 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE main_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, sub_sub_category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, model VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, desc_one LONGTEXT DEFAULT NULL, desc_two LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_D34A04ADED049853 (sub_sub_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_category (id INT AUTO_INCREMENT NOT NULL, main_category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_BCE3F798C6C55574 (main_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sub_sub_category (id INT AUTO_INCREMENT NOT NULL, sub_category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL, INDEX IDX_ABB1B0AEF7BFE87C (sub_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADED049853 FOREIGN KEY (sub_sub_category_id) REFERENCES sub_sub_category (id)');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F798C6C55574 FOREIGN KEY (main_category_id) REFERENCES main_category (id)');
        $this->addSql('ALTER TABLE sub_sub_category ADD CONSTRAINT FK_ABB1B0AEF7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sub_category DROP FOREIGN KEY FK_BCE3F798C6C55574');
        $this->addSql('ALTER TABLE sub_sub_category DROP FOREIGN KEY FK_ABB1B0AEF7BFE87C');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADED049853');
        $this->addSql('DROP TABLE main_category');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE sub_category');
        $this->addSql('DROP TABLE sub_sub_category');
    }
}
