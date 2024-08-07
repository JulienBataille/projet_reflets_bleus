<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240807074233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE slider (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE media ADD slider_id INT NOT NULL, ADD size INT NOT NULL, ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP alt_text, DROP filename');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C2CCC9638 FOREIGN KEY (slider_id) REFERENCES slider (id)');
        $this->addSql('CREATE INDEX IDX_6A2CA10C2CCC9638 ON media (slider_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C2CCC9638');
        $this->addSql('DROP TABLE slider');
        $this->addSql('DROP INDEX IDX_6A2CA10C2CCC9638 ON media');
        $this->addSql('ALTER TABLE media ADD alt_text VARCHAR(255) DEFAULT NULL, ADD filename VARCHAR(255) NOT NULL, DROP slider_id, DROP size, DROP updated_at');
    }
}
