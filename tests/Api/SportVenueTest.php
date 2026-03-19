<?php

declare(strict_types=1);

namespace App\Tests\Api;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\SportVenue;
use Doctrine\ORM\EntityManagerInterface;

class SportVenueTest extends ApiTestCase
{
	private EntityManagerInterface $em;
	
	protected function setUp(): void
	{
		$kernel   = self::bootKernel();
		$this->em = $kernel->getContainer()->get('doctrine')->getManager();

		$v1 = new SportVenue();
		$v1->setName('test arena');
		$v1->setLat('11.1111');
		$v1->setLng('22.2222');
		$this->em->persist($v1);

		$v2 = new SportVenue();
		$v2->setName('test arena 2');
		$v2->setLat('34.5674');
		$v2->setLng('25.1234');
		$this->em->persist($v2);
		
		$this->em->flush();
	}
	
	protected function tearDown(): void
	{
		$this->em->createQuery('DELETE FROM App\Entity\SportVenue')->execute();
		parent::tearDown();
		restore_exception_handler();
	}
	
	public function testGetAllSportVenues(): void
	{
		$response = static::createClient()->request('GET', '/api/sport_venues', [
			'headers' => ['Accept' => 'application/ld+json'],
		]);
		
		$this->assertResponseIsSuccessful();
		$data = $response->toArray();
		$this->assertSame(2, $data['totalItems']);
	}
}