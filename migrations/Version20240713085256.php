<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240713085256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment_categories (comment_id INT NOT NULL, categories_id INT NOT NULL, INDEX IDX_B812CC48F8697D13 (comment_id), INDEX IDX_B812CC48A21214B7 (categories_id), PRIMARY KEY(comment_id, categories_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment_categories ADD CONSTRAINT FK_B812CC48F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_categories ADD CONSTRAINT FK_B812CC48A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment_categories DROP FOREIGN KEY FK_B812CC48F8697D13');
        $this->addSql('ALTER TABLE comment_categories DROP FOREIGN KEY FK_B812CC48A21214B7');
        $this->addSql('DROP TABLE comment_categories');
    }
}
