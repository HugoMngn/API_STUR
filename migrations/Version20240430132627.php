<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240430132627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, diary_id INT NOT NULL, category_id INT NOT NULL, metadata VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_AC74095AE020E47A (diary_id), UNIQUE INDEX UNIQ_AC74095A12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_64C19C1727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE diary (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, user_pseudonym VARCHAR(255) NOT NULL, open TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', duration INT NOT NULL, UNIQUE INDEX UNIQ_917BEDE2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etude (id INT AUTO_INCREMENT NOT NULL, filiere_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_1DDEA924180AA129 (filiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, pseudonyme VARCHAR(255) NOT NULL, email_adress VARCHAR(255) NOT NULL, age INT NOT NULL, gender VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_etude (user_id INT NOT NULL, etude_id INT NOT NULL, INDEX IDX_FF1C527CA76ED395 (user_id), INDEX IDX_FF1C527C47ABD362 (etude_id), PRIMARY KEY(user_id, etude_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095AE020E47A FOREIGN KEY (diary_id) REFERENCES diary (id)');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE diary ADD CONSTRAINT FK_917BEDE2A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE etude ADD CONSTRAINT FK_1DDEA924180AA129 FOREIGN KEY (filiere_id) REFERENCES etude (id)');
        $this->addSql('ALTER TABLE user_etude ADD CONSTRAINT FK_FF1C527CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_etude ADD CONSTRAINT FK_FF1C527C47ABD362 FOREIGN KEY (etude_id) REFERENCES etude (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095AE020E47A');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095A12469DE2');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE diary DROP FOREIGN KEY FK_917BEDE2A76ED395');
        $this->addSql('ALTER TABLE etude DROP FOREIGN KEY FK_1DDEA924180AA129');
        $this->addSql('ALTER TABLE user_etude DROP FOREIGN KEY FK_FF1C527CA76ED395');
        $this->addSql('ALTER TABLE user_etude DROP FOREIGN KEY FK_FF1C527C47ABD362');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE diary');
        $this->addSql('DROP TABLE etude');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_etude');
    }
}
