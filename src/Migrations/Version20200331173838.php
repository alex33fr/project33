<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200331173838 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE main_category CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD sub_category_id INT DEFAULT NULL, CHANGE sub_sub_category_id sub_sub_category_id INT DEFAULT NULL, CHANGE model model VARCHAR(255) DEFAULT NULL, CHANGE color color VARCHAR(255) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADF7BFE87C FOREIGN KEY (sub_category_id) REFERENCES sub_category (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADF7BFE87C ON product (sub_category_id)');
        $this->addSql('ALTER TABLE sub_category CHANGE main_category_id main_category_id INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE sub_sub_category CHANGE sub_category_id sub_category_id INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE main_category CHANGE created_at created_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADF7BFE87C');
        $this->addSql('DROP INDEX IDX_D34A04ADF7BFE87C ON product');
        $this->addSql('ALTER TABLE product DROP sub_category_id, CHANGE sub_sub_category_id sub_sub_category_id INT DEFAULT NULL, CHANGE model model VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE color color VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE created_at created_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE sub_category CHANGE main_category_id main_category_id INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE sub_sub_category CHANGE sub_category_id sub_category_id INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT \'NULL\'');
    }
}
