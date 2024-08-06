<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240806074249 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE catalogue DROP FOREIGN KEY FK_59A699F53569D950');
        $this->addSql('ALTER TABLE catalogue DROP FOREIGN KEY FK_59A699F5511FC912');
        $this->addSql('DROP TABLE catalogue');
        $this->addSql('ALTER TABLE catalogues ADD is_visible TINYINT(1) NOT NULL, CHANGE pdf pdf VARCHAR(255) DEFAULT NULL, CHANGE name title VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE catalogue (id INT AUTO_INCREMENT NOT NULL, featured_image_id INT DEFAULT NULL, pdf_id INT DEFAULT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, is_visible TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_59A699F53569D950 (featured_image_id), UNIQUE INDEX UNIQ_59A699F5511FC912 (pdf_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE catalogue ADD CONSTRAINT FK_59A699F53569D950 FOREIGN KEY (featured_image_id) REFERENCES media (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE catalogue ADD CONSTRAINT FK_59A699F5511FC912 FOREIGN KEY (pdf_id) REFERENCES media (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE catalogues DROP is_visible, CHANGE pdf pdf VARCHAR(255) NOT NULL, CHANGE title name VARCHAR(255) NOT NULL');
    }
}
