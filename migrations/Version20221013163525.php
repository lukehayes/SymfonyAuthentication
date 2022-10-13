<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221013163525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__task AS SELECT id, user_id_id, task, completed FROM task');
        $this->addSql('DROP TABLE task');
        $this->addSql('CREATE TABLE task (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id_id INTEGER DEFAULT NULL, category_id INTEGER DEFAULT NULL, task VARCHAR(255) NOT NULL, completed BOOLEAN NOT NULL, CONSTRAINT FK_527EDB259D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_527EDB2512469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO task (id, user_id_id, task, completed) SELECT id, user_id_id, task, completed FROM __temp__task');
        $this->addSql('DROP TABLE __temp__task');
        $this->addSql('CREATE INDEX IDX_527EDB259D86650F ON task (user_id_id)');
        $this->addSql('CREATE INDEX IDX_527EDB2512469DE2 ON task (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__task AS SELECT id, user_id_id, task, completed FROM task');
        $this->addSql('DROP TABLE task');
        $this->addSql('CREATE TABLE task (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id_id INTEGER DEFAULT NULL, task VARCHAR(255) NOT NULL, completed BOOLEAN NOT NULL, CONSTRAINT FK_527EDB259D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO task (id, user_id_id, task, completed) SELECT id, user_id_id, task, completed FROM __temp__task');
        $this->addSql('DROP TABLE __temp__task');
        $this->addSql('CREATE INDEX IDX_527EDB259D86650F ON task (user_id_id)');
    }
}
