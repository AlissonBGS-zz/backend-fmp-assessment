<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class UtilsTest extends WebTestCase
{    
    public function testServiceGettesAndSetters(): void
    {
        $service = new App\Entity\Services;

        $service->setName('ServiceName');
        $service->setSlug('service_slug');
        $service->setDescription('ServiceDescription');
        $service->setTiers([
            "Basic" => 200,
            "Professional" => 300,
            "Executive" => 400
        ]);

        $this->assertEquals( $service->getName(), 'ServiceName');
        $this->assertEquals( $service->getSlug(), 'service_slug');
        $this->assertEquals( $service->getDescription(), 'ServiceDescription');
        $this->assertEquals( $service->getTiers(), [
            "Basic" => 200,
            "Professional" => 300,
            "Executive" => 400
        ]);
    }

    public function testClientGettesAndSetters(): void
    {
        $client = new App\Entity\Clients;

        $client->setFirstName('Alisson');
        $client->setLastName('Sabino');
        $client->setEmail('alissonbgs97@gmail.com');
        $client->setPassword('fakepass');
        $client->setToken('faketoken');
        $client->setAddress('Rua Mário Braz, 196');
        $client->setCountry('Brazil');
        $client->setState('Minas Gerais');
        $client->setZipCode('37500-202');
        $client->setPaymentType('PayPal');
        $client->setServices(["resume_writing" => "Executive"]);
        $created_at = new \DateTime('now');
        $client->setCreatedAt($created_at);

        $this->assertEquals( $client->getFirstName(), 'Alisson');
        $this->assertEquals( $client->getLastName(), 'Sabino');
        $this->assertEquals( $client->getEmail(), 'alissonbgs97@gmail.com');
        $this->assertEquals( $client->getAddress(), 'Rua Mário Braz, 196');
        $this->assertEquals( $client->getCountry(), 'Brazil');
        $this->assertEquals( $client->getState(), 'Minas Gerais');
        $this->assertEquals( $client->getZipCode(), '37500-202');
        $this->assertEquals( $client->getPaymentType(), 'PayPal');
        $this->assertEquals( $client->getServices(), ["resume_writing" => "Executive"]);
        $this->assertEquals( $client->getCreatedAt(), $created_at);
    }
}
