<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use App\Api\SportVenue\Filter\DistanceFilter;
use ApiPlatform\Metadata\ApiFilter;
use App\Repository\SportVenueRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SportVenueRepository::class)]
#[ORM\Index(name: 'idx_lat_lng', columns: ['lat', 'lng'])]
#[ApiResource(
	operations: [
		new GetCollection(),
	],
	normalizationContext: ['groups' => ['venue:read']],
	paginationItemsPerPage: 20,
)]
#[ApiFilter(DistanceFilter::class)]
class SportVenue
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
	#[Groups('venue:read')]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
	#[Groups('venue:read')]
    private ?string $lat = null;

    #[ORM\Column(length: 255)]
	#[Groups('venue:read')]
    private ?string $lng = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(string $lat): static
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?string
    {
        return $this->lng;
    }

    public function setLng(string $lng): static
    {
        $this->lng = $lng;

        return $this;
    }
}
