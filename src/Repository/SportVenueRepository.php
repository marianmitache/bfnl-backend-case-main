<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\SportVenue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<SportVenue>
 */
class SportVenueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SportVenue::class);
    }
	
	public static function filterByDistance(
		QueryBuilder $qb,
		float $lat,
		float $lng,
		float $distance
	): void
	{
		$alias = $qb->getRootAliases()[0];
		
		$latRange = $distance / 111;
		$lngRange = $distance / (111 * cos(deg2rad($lat)));

		$minLat = $lat - $latRange;
		$maxLat = $lat + $latRange;
		$minLng = $lng - $lngRange;
		$maxLng = $lng + $lngRange;

		$qb
			->andWhere("$alias.lat BETWEEN :minLat AND :maxLat")
			->andWhere("$alias.lng BETWEEN :minLng AND :maxLng")
			->andWhere("(6371 * ACOS(
    			COS(RADIANS(:lat)) * COS(RADIANS($alias.lat)) *
        		COS(RADIANS($alias.lng) - RADIANS(:lng)) +
        		SIN(RADIANS(:lat)) * SIN(RADIANS($alias.lat))
    		)) <= :distance")
			->setParameter('minLat', $minLat)
			->setParameter('maxLat', $maxLat)
			->setParameter('minLng', $minLng)
			->setParameter('maxLng', $maxLng)
			->setParameter('lat', $lat)
			->setParameter('lng', $lng)
			->setParameter('distance', $distance);
	}
}
