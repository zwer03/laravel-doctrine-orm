<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20221026023628 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE scientist ADD street VARCHAR(255) DEFAULT NULL, ADD postal_code VARCHAR(255) DEFAULT NULL, ADD city VARCHAR(255) DEFAULT NULL, ADD country VARCHAR(255) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE scientist DROP street, DROP postal_code, DROP city, DROP country');
    }
}
