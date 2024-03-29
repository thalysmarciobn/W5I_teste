<?php
namespace App\Domain\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Categoria",
 *     title="Categoria",
 *     description="Entidade dos Categorias"
 * )
 */
#[ORM\Entity]
#[ORM\Table(name: 'categorias')]
class Categoria
{
    #[ORM\Id, ORM\Column(type: 'integer'), ORM\GeneratedValue]
    private int|null $id = null;

    /**
     * Categoria de Veículo
     * @var string
     * @OA\Property()
     */
    #[ORM\Column(type: 'string')]
    private string $nome;

    /**
     * Taxa de Veículo
     * @var float
     * @OA\Property()
     */
    #[ORM\Column(type: 'float')]
    private string $taxa;

    #[ORM\OneToMany(targetEntity: "Carro", mappedBy: "categoria")]
    private Collection $carros;

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getTaxa(): float
    {
        return $this->taxa;
    }

    public function setTaxa(float $taxa): void
    {
        $this->taxa = $taxa;
    }

    public function getCarros(): Collection
    {
        return $this->carros;
    }
}