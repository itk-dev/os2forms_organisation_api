<?php

namespace App\Entity\Model;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\Repository\FunktionsDataRepository;
use App\State\FunktionOrganisationProvider;
use App\State\FunktionOrganisationTreeProvider;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FunktionsDataRepository::class, readOnly: true)]
#[ORM\Table(name: 'funktions_data')]
#[ApiResource(
    operations: [
        new Get(
            uriTemplate: 'funktion/{id}',
            routePrefix: 'v1/',
            shortName: 'Funktion',
            normalizationContext: ['groups' => 'funktion:item']
        ),
        new Get(
            uriTemplate: 'funktion/{id}/organisation',
            routePrefix: 'v1/',
            shortName: 'Funktion',
            normalizationContext: ['groups' => ['organisation:item']],
            provider: FunktionOrganisationProvider::class,
        ),
        new Get(
            uriTemplate: 'funktion/{id}/organisation-tree',
            routePrefix: 'v1/',
            shortName: 'Funktion',
            normalizationContext: ['groups' => ['organisation:item']],
            provider: FunktionOrganisationTreeProvider::class,
        ),
    ],
    paginationEnabled: false,
)]
class FunktionsData
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column]
    #[Groups(['funktion:item'])]
    private string $id;

    #[ORM\Column(length: 255)]
    #[Groups(['funktion:item'])]
    private string $funktionsnavn;

    #[ORM\Column(length: 255)]
    #[Groups(['funktion:item'])]
    private string $enhedsnavn;

    #[ORM\Column(length: 255)]
    #[Groups(['funktion:item'])]
    private string $adresse;

    #[ORM\Column(length: 255)]
    #[Groups(['funktion:item'])]
    private string $brugerId;

    #[ORM\Column(length: 255)]
    #[Groups(['funktion:item'])]
    private string $tilknyttetEnhedId;

    #[ORM\Column(length: 255)]
    #[Groups(['funktion:item'])]
    private string $funktionsType;

    private function __construct()
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getFunktionsnavn(): string
    {
        return $this->funktionsnavn;
    }

    public function getEnhedsnavn(): string
    {
        return $this->enhedsnavn;
    }

    public function getAdresse(): string
    {
        return $this->adresse;
    }

    public function getBrugerId(): string
    {
        return $this->brugerId;
    }

    public function getTilknyttetEnhedId(): string
    {
        return $this->tilknyttetEnhedId;
    }

    public function getFunktionsType(): string
    {
        return $this->funktionsType;
    }
}
