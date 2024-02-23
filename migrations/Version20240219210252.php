<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219210252 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pret ADD pret_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pret ADD CONSTRAINT FK_52ECE979F048F32 FOREIGN KEY (pret_id_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_52ECE979F048F32 ON pret (pret_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pret DROP FOREIGN KEY FK_52ECE979F048F32');
        $this->addSql('DROP INDEX IDX_52ECE979F048F32 ON pret');
        $this->addSql('ALTER TABLE pret DROP pret_id_id');
    }
}
