<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220623154838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE missions_history (id INT AUTO_INCREMENT NOT NULL, mission_id_id INT DEFAULT NULL, evaluated_date DATETIME NOT NULL, completed_date DATETIME NOT NULL, INDEX IDX_3FCBE138EFD2C16A (mission_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE missions_history ADD CONSTRAINT FK_3FCBE138EFD2C16A FOREIGN KEY (mission_id_id) REFERENCES mission (id)');
        $this->addSql('ALTER TABLE mission ADD evaluated INT DEFAULT NULL, ADD completed INT DEFAULT NULL, ADD days_of_week VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE missions_history');
        $this->addSql('ALTER TABLE mission DROP evaluated, DROP completed, DROP days_of_week');
    }
}
