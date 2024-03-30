<?php
namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Estacionamento",
 *     title="Estacionamento",
 *     description="Entidade do Estacionamento"
 * )
 */
#[ORM\Entity]
#[ORM\Table(name: 'estacionamento')]
class Estacionamento
{
    #[ORM\Id, ORM\Column(type: 'integer'), ORM\GeneratedValue]
    private int|null $id = null;

    /**
     * Data de Entrada do Veículo,
     * @var \DateTime
     * @OA\Property()
     */
    #[ORM\Column(type: 'datetime')]
    private ?\DateTime $entrada;

    /**
     * Data de Saída do Veículo,
     * @var \DateTime
     * @OA\Property()
     */
    #[ORM\Column(type: 'datetime')]
    private ?\DateTime $saida;

    /**
     * Caso o Veículo Esteja Estacionado,
     * @var integer
     * @OA\Property()
     */
    #[ORM\Column(type: 'integer')]
    private int $park;

    /**
     * Valor do Estacionamento
     * @var float
     * @OA\Property()
     */
    #[ORM\Column(type: 'float')]
    private float $valor;

    #[ORM\ManyToOne(targetEntity: "Carro")]
    #[ORM\JoinColumn(name: "carro_id", referencedColumnName: "id")]
    private Carro $carro;

    public function getEntrada(): ?\DateTime
    {
        return $this->entrada;
    }

    public function setEntrada(\DateTime $dateTime): void
    {
        $this->entrada = $dateTime;
    }

    public function getSaida(): ?\DateTime
    {
        return $this->saida;
    }

    public function setSaida(\DateTime $dateTime): void
    {
        $this->saida = $dateTime;
    }

    public function getPark(): int
    {
        return $this->park;
    }

    public function setPark(int $park): void
    {
        $this->park = $park;
    }

    public function getValor(): float
    {
        return $this->valor;
    }

    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    public function getCarro(): ?Carro
    {
        return $this->carro;
    }

    public function setCarro(Carro $carro): void
    {
        $this->carro = $carro;
    }

}
