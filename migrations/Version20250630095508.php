<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250630095508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plant ADD plant_blueprint_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plant ADD CONSTRAINT FK_AB030D7296E36B5A FOREIGN KEY (plant_blueprint_id) REFERENCES plant_blueprint (id)');
        $this->addSql('CREATE INDEX IDX_AB030D7296E36B5A ON plant (plant_blueprint_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plant DROP FOREIGN KEY FK_AB030D7296E36B5A');
        $this->addSql('DROP INDEX IDX_AB030D7296E36B5A ON plant');
        $this->addSql('ALTER TABLE plant DROP plant_blueprint_id');
    }
}
