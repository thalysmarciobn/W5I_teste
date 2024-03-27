<?php
namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Carro",
 *     title="Carro",
 *     description="Modelo de carro"
 * )
 */
#[ORM\Entity]
#[ORM\Table(name: 'carros')]
class Carro
{
    #[ORM\Id, ORM\Column(type: 'integer'), ORM\GeneratedValue]
    private int|null $id = null;

    /**
     * Placa do Veículo,
     * @var string
     * @OA\Property()
     */
    #[ORM\Column(type: 'string')]
    private string $placa;

    public function getPlaca(): string
    {
        return $this->placa;
    }

    public function setPlaca(string $placa): void
    {
        $this->placa = $placa;
    }
}
