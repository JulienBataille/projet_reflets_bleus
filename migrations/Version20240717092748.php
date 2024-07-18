<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240717092748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE catalogue ADD featured_image_id INT NOT NULL, ADD pdf_id INT NOT NULL, ADD is_visible TINYINT(1) NOT NULL, DROP pdf');
        $this->addSql('ALTER TABLE catalogue ADD CONSTRAINT FK_59A699F53569D950 FOREIGN KEY (featured_image_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE catalogue ADD CONSTRAINT FK_59A699F5511FC912 FOREIGN KEY (pdf_id) REFERENCES media (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_59A699F53569D950 ON catalogue (featured_image_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_59A699F5511FC912 ON catalogue (pdf_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE catalogue DROP FOREIGN KEY FK_59A699F53569D950');
        $this->addSql('ALTER TABLE catalogue DROP FOREIGN KEY FK_59A699F5511FC912');
        $this->addSql('DROP INDEX UNIQ_59A699F53569D950 ON catalogue');
        $this->addSql('DROP INDEX UNIQ_59A699F5511FC912 ON catalogue');
        $this->addSql('ALTER TABLE catalogue ADD pdf VARCHAR(255) NOT NULL, DROP featured_image_id, DROP pdf_id, DROP is_visible');
    }
}
