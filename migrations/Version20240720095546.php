<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240720095546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `option` CHANGE value value TINYTEXT DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A8600B0EA750E8 ON `option` (label)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_5A8600B0EA750E8 ON `option`');
        $this->addSql('ALTER TABLE `option` CHANGE value value VARCHAR(255) DEFAULT NULL');
    }
}
