<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20221026063158 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE animals (id INT AUTO_INCREMENT NOT NULL, color VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cats (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dogs (id INT NOT NULL, kennel VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cats ADD CONSTRAINT FK_C39DBA92BF396750 FOREIGN KEY (id) REFERENCES animals (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dogs ADD CONSTRAINT FK_353BEEB3BF396750 FOREIGN KEY (id) REFERENCES animals (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cats DROP FOREIGN KEY FK_C39DBA92BF396750');
        $this->addSql('ALTER TABLE dogs DROP FOREIGN KEY FK_353BEEB3BF396750');
        $this->addSql('DROP TABLE animals');
        $this->addSql('DROP TABLE cats');
        $this->addSql('DROP TABLE dogs');
    }
}
