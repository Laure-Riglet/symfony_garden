<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250630143956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE family (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_A5E6215B12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plant_blueprint_tag (plant_blueprint_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_E375849196E36B5A (plant_blueprint_id), INDEX IDX_E3758491BAD26311 (tag_id), PRIMARY KEY(plant_blueprint_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_blueprint (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_596F2F37B03A8386 (created_by_id), INDEX IDX_596F2F37896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_blueprint_plant_blueprint (task_blueprint_id INT NOT NULL, plant_blueprint_id INT NOT NULL, INDEX IDX_5A28D0C1887472D8 (task_blueprint_id), INDEX IDX_5A28D0C196E36B5A (plant_blueprint_id), PRIMARY KEY(task_blueprint_id, plant_blueprint_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE plant_blueprint_tag ADD CONSTRAINT FK_E375849196E36B5A FOREIGN KEY (plant_blueprint_id) REFERENCES plant_blueprint (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plant_blueprint_tag ADD CONSTRAINT FK_E3758491BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task_blueprint ADD CONSTRAINT FK_596F2F37B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE task_blueprint ADD CONSTRAINT FK_596F2F37896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE task_blueprint_plant_blueprint ADD CONSTRAINT FK_5A28D0C1887472D8 FOREIGN KEY (task_blueprint_id) REFERENCES task_blueprint (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task_blueprint_plant_blueprint ADD CONSTRAINT FK_5A28D0C196E36B5A FOREIGN KEY (plant_blueprint_id) REFERENCES plant_blueprint (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B12469DE2');
        $this->addSql('ALTER TABLE plant_blueprint_tag DROP FOREIGN KEY FK_E375849196E36B5A');
        $this->addSql('ALTER TABLE plant_blueprint_tag DROP FOREIGN KEY FK_E3758491BAD26311');
        $this->addSql('ALTER TABLE task_blueprint DROP FOREIGN KEY FK_596F2F37B03A8386');
        $this->addSql('ALTER TABLE task_blueprint DROP FOREIGN KEY FK_596F2F37896DBBDE');
        $this->addSql('ALTER TABLE task_blueprint_plant_blueprint DROP FOREIGN KEY FK_5A28D0C1887472D8');
        $this->addSql('ALTER TABLE task_blueprint_plant_blueprint DROP FOREIGN KEY FK_5A28D0C196E36B5A');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE family');
        $this->addSql('DROP TABLE plant_blueprint_tag');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE task_blueprint');
        $this->addSql('DROP TABLE task_blueprint_plant_blueprint');
    }
}
