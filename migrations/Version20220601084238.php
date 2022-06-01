<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601084238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_contracts (user_id INT NOT NULL, contracts_id INT NOT NULL, INDEX IDX_9B02497A76ED395 (user_id), INDEX IDX_9B0249724584564 (contracts_id), PRIMARY KEY(user_id, contracts_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_contracts ADD CONSTRAINT FK_9B02497A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_contracts ADD CONSTRAINT FK_9B0249724584564 FOREIGN KEY (contracts_id) REFERENCES contracts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE bonus ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bonus ADD CONSTRAINT FK_9F987F7AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9F987F7AA76ED395 ON bonus (user_id)');
        $this->addSql('ALTER TABLE mission ADD categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mission ADD CONSTRAINT FK_9067F23CA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_9067F23CA21214B7 ON mission (categories_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_contracts');
        $this->addSql('ALTER TABLE bonus DROP FOREIGN KEY FK_9F987F7AA76ED395');
        $this->addSql('DROP INDEX IDX_9F987F7AA76ED395 ON bonus');
        $this->addSql('ALTER TABLE bonus DROP user_id');
        $this->addSql('ALTER TABLE mission DROP FOREIGN KEY FK_9067F23CA21214B7');
        $this->addSql('DROP INDEX IDX_9067F23CA21214B7 ON mission');
        $this->addSql('ALTER TABLE mission DROP categories_id');
    }
}
