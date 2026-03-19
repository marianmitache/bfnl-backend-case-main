<?php

declare(strict_types=1);

namespace App\Api\SportVenue\Filter;

use ApiPlatform\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use App\Repository\SportVenueRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\PropertyInfo\Type;

final class DistanceFilter extends AbstractFilter
{
	public function apply(
		QueryBuilder $queryBuilder,
		QueryNameGeneratorInterface $queryNameGenerator,
		string $resourceClass,
		?Operation $operation = null,
		array $context = []
	): void
	{
		$filters  = $context['filters'] ?? [];
		$lat      = isset($filters['lat'])      ? (float) $filters['lat']      : null;
		$lng      = isset($filters['lng'])      ? (float) $filters['lng']      : null;
		$distance = isset($filters['distance']) ? (float) $filters['distance'] : null;
		
		if ($lat === null || $lng === null || $distance === null) {
			return;
		}
		
		SportVenueRepository::filterByDistance($queryBuilder, $lat, $lng, $distance);
	}
	
	protected function filterProperty(
		string $property,
		mixed $value,
		QueryBuilder $queryBuilder,
		QueryNameGeneratorInterface $queryNameGenerator,
		string $resourceClass,
		?Operation $operation = null,
		array $context = []
	): void {}
	
	public function getDescription(string $resourceClass): array
	{
		return [
			'lat'      => ['property' => null, 'type' => Type::BUILTIN_TYPE_FLOAT, 'required' => false, 'description' => 'Latitude'],
			'lng'      => ['property' => null, 'type' => Type::BUILTIN_TYPE_FLOAT, 'required' => false, 'description' => 'Longitude'],
			'distance' => ['property' => null, 'type' => Type::BUILTIN_TYPE_FLOAT, 'required' => false, 'description' => 'Distance in km'],
		];
	}
}