<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210424011052 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE objectif ADD image VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME NOT NULL, ADD date_fin VARCHAR(15) DEFAULT NULL, CHANGE mailchecked mailchecked INT DEFAULT NULL, CHANGE icone icone VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE suivi ADD color VARCHAR(7) DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP googleAuthenticatorSecret, DROP googleAccount, CHANGE nom nom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, selector VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, hashed_token VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');

        $this->addSql('ALTER TABLE user ADD googleAuthenticatorSecret VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`, ADD googleAccount VARCHAR(255) CHARACTER SET latin1 DEFAULT \'N\' NOT NULL COLLATE `latin1_swedish_ci`, CHANGE nom nom VARCHAR(255) CHARACTER SET latin1 DEFAULT NULL COLLATE `latin1_swedish_ci`');
    }
}
