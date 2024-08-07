<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240807081505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE slider ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE slider ADD CONSTRAINT FK_CFC7100712469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_CFC7100712469DE2 ON slider (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE slider DROP FOREIGN KEY FK_CFC7100712469DE2');
        $this->addSql('DROP INDEX IDX_CFC7100712469DE2 ON slider');
        $this->addSql('ALTER TABLE slider DROP category_id');
    }
}
