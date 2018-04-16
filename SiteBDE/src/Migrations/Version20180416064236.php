<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180416064236 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comment_entity (id INT AUTO_INCREMENT NOT NULL, date_comment DATE NOT NULL, iduser INT NOT NULL, is_flagged TINYINT(1) NOT NULL, id_like INT NOT NULL, id_parent INT NOT NULL, id_photo INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manifestation_entity (id INT AUTO_INCREMENT NOT NULL, iduser INT NOT NULL, titre VARCHAR(100) NOT NULL, idactivite INT NOT NULL, contenu VARCHAR(255) NOT NULL, date_manifestation DATE NOT NULL, image VARCHAR(255) NOT NULL, type_recurrence VARCHAR(255) NOT NULL, prix VARCHAR(100) NOT NULL, is_flagged TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo_entity (id INT AUTO_INCREMENT NOT NULL, path VARCHAR(255) NOT NULL, nblike INT DEFAULT NULL, is_flagged TINYINT(1) NOT NULL, id_like INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_entity (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, mail VARCHAR(50) NOT NULL, mdp VARCHAR(50) NOT NULL, idstatus INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE comment_entity');
        $this->addSql('DROP TABLE manifestation_entity');
        $this->addSql('DROP TABLE photo_entity');
        $this->addSql('DROP TABLE user_entity');
    }
}
