<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250630054911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE plant_blueprint (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, updated_by_id INT NOT NULL, name VARCHAR(255) NOT NULL, species VARCHAR(255) NOT NULL, sun_requirements LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', watering_needs SMALLINT NOT NULL, germination_months JSON NOT NULL COMMENT \'(DC2Type:json)\', planting_months JSON NOT NULL COMMENT \'(DC2Type:json)\', flowering_months JSON NOT NULL COMMENT \'(DC2Type:json)\', harvest_months JSON NOT NULL COMMENT \'(DC2Type:json)\', hardiness SMALLINT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_A30971FEB03A8386 (created_by_id), INDEX IDX_A30971FE896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE plant_blueprint ADD CONSTRAINT FK_A30971FEB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE plant_blueprint ADD CONSTRAINT FK_A30971FE896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plant_blueprint DROP FOREIGN KEY FK_A30971FEB03A8386');
        $this->addSql('ALTER TABLE plant_blueprint DROP FOREIGN KEY FK_A30971FE896DBBDE');
        $this->addSql('DROP TABLE plant_blueprint');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
    }
}
