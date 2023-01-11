<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220305160846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, sender_id INT NOT NULL, recipient_id INT NOT NULL, objet VARCHAR(255) NOT NULL, message VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, is_read TINYINT(1) NOT NULL, INDEX IDX_B6BD307FF624B39D (sender_id), INDEX IDX_B6BD307FE92F8F78 (recipient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FE92F8F78 FOREIGN KEY (recipient_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE capteur CHANGE ref ref VARCHAR(11) DEFAULT NULL');
        $this->addSql('ALTER TABLE valeur DROP FOREIGN KEY valeur_ibfk_1');
        $this->addSql('ALTER TABLE valeur CHANGE id_capteur id_capteur INT DEFAULT NULL');
        $this->addSql('ALTER TABLE valeur ADD CONSTRAINT FK_1B44CD5185D7BFE5 FOREIGN KEY (id_capteur) REFERENCES capteur (id_capteur)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE message');
        $this->addSql('ALTER TABLE capteur CHANGE ref ref VARCHAR(255) NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_general_ci`');
        $this->addSql('ALTER TABLE intervalle CHANGE id_intervalle id_intervalle VARCHAR(11) NOT NULL COLLATE `utf8mb4_general_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE valeur DROP FOREIGN KEY FK_1B44CD5185D7BFE5');
        $this->addSql('ALTER TABLE valeur CHANGE id_capteur id_capteur INT NOT NULL');
        $this->addSql('ALTER TABLE valeur ADD CONSTRAINT valeur_ibfk_1 FOREIGN KEY (id_capteur) REFERENCES capteur (id_capteur) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
