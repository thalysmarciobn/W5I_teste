<?php
namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Carro",
 *     title="Carro",
 *     description="Entidade dos Carros"
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

    /**
     * Modelo do Veículo,
     * @var CarroModelo
     * @OA\Property()
     */
    #[ORM\ManyToOne(targetEntity: Categoria::class)]
    #[ORM\JoinColumn(name: 'categoria_id', referencedColumnName: 'id')]
    private Categoria $categoria;

    /**
     * Cor do Veículo,
     * @var string
     * @OA\Property()
     */
    #[ORM\Column(type: 'string')]
    private string $cor;

    public function getPlaca(): string
    {
        return $this->placa;
    }

    public function setPlaca(string $placa): void
    {
        $this->placa = $placa;
    }

    public function getCor(): string
    {
        return $this->cor;
    }

    public function setCor(string $cor): void
    {
        $this->cor = $cor;
    }

    public function getCategoria(): Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(Categoria $categoria): void
    {
        $this->categoria = $categoria;
    }
}
