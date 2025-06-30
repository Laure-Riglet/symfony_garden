<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250630151759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plant_blueprint ADD category_id INT NOT NULL, ADD family_id INT NOT NULL');
        $this->addSql('ALTER TABLE plant_blueprint ADD CONSTRAINT FK_A30971FE12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE plant_blueprint ADD CONSTRAINT FK_A30971FEC35E566A FOREIGN KEY (family_id) REFERENCES family (id)');
        $this->addSql('CREATE INDEX IDX_A30971FE12469DE2 ON plant_blueprint (category_id)');
        $this->addSql('CREATE INDEX IDX_A30971FEC35E566A ON plant_blueprint (family_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plant_blueprint DROP FOREIGN KEY FK_A30971FE12469DE2');
        $this->addSql('ALTER TABLE plant_blueprint DROP FOREIGN KEY FK_A30971FEC35E566A');
        $this->addSql('DROP INDEX IDX_A30971FE12469DE2 ON plant_blueprint');
        $this->addSql('DROP INDEX IDX_A30971FEC35E566A ON plant_blueprint');
        $this->addSql('ALTER TABLE plant_blueprint DROP category_id, DROP family_id');
    }
}
