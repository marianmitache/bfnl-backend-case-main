<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260319184255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE INDEX idx_lat_lng ON sport_venue (lat, lng)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP INDEX idx_lat_lng ON sport_venue');
    }
}
