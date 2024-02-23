<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221223037 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE remboursement ADD rmb_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE remboursement ADD CONSTRAINT FK_C0C0D9EF9EA59D3F FOREIGN KEY (rmb_id) REFERENCES pret (id)');
        $this->addSql('CREATE INDEX IDX_C0C0D9EF9EA59D3F ON remboursement (rmb_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE remboursement DROP FOREIGN KEY FK_C0C0D9EF9EA59D3F');
        $this->addSql('DROP INDEX IDX_C0C0D9EF9EA59D3F ON remboursement');
        $this->addSql('ALTER TABLE remboursement DROP rmb_id');
    }
}
