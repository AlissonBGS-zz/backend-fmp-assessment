<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210601204711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(100) NOT NULL, token VARCHAR(100) NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(50) NOT NULL, state VARCHAR(50) NOT NULL, zip_code VARCHAR(50) NOT NULL, payment_type VARCHAR(50) NOT NULL, services JSON DEFAULT NULL, created_at DATETIME DEFAULT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, tiers JSON NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    
        $services = (Object) [
            (Object)[
                "name" => "Resume Writing",
                "slug" => "resume-writing",
                "description" => "Our resume writers have experience in 85+ different career types and we match you with a writer based on relevant experience.",
                "tiers" => [
                    "Basic" => 200,
                    "Professional" => 500,
                    "Executive" => 1000,
                ]
            ],
            (Object)[
                "name" => "Carrer Coaching",
                "slug" => "carrer-coaching",
                "description" => "Our professional career coaching services are provided by former recruiters, headhunters, and/or executive resume writers only. We ensure the absolute highest quality of career coaches and will always do our best to match you with the career coach that we feel is right for you.",
                "tiers" => [
                    "Basic" => 400,
                    "Professional" => 500,
                    "Executive" => 700,
                ]
            ],
            (Object)[
                "name" => "Likedin profile update",
                "slug" => "linkedin-profile-update",
                "description" => "LinkedIn is an ever-changing professional social network. They offer a ton of great tools to help you find jobs, and more importantly, find the people you need to network with in order to land that dream job.",
                "tiers" => [
                    "Basic" => 100,
                    "Professional" => 150,
                    "Executive" => 300,
                ]
            ],
        ];

        foreach($services as $service){
            $service_tiers = json_encode($service->tiers);
            $this->addSql("INSERT INTO services (name, slug, description, tiers) VALUES('$service->name', '$service->slug', '$service->description', '$service_tiers')");
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE services');
    }
}
