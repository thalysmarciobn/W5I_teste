<?php
namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="CarroModelo",
 *     title="CarroModelo",
 *     description="Entidade dos Modelos de Veículos"
 * )
 */
#[ORM\Entity]
#[ORM\Table(name: 'carros_modelos')]
class CarroModelo
{
    #[ORM\Id, ORM\Column(type: 'integer'), ORM\GeneratedValue]
    private int|null $id = null;

    /**
     * Nome do Modelo do Veículo,
     * @var string
     * @OA\Property()
     */
    #[ORM\Column(type: 'string')]
    private string $nome;

    /**
     * Descrição do Modelo do Veículo,
     * @var string
     * @OA\Property()
     */
    #[ORM\Column(type: 'string')]
    private string $descricao;

    /**
     * Categoria do Modelo do Veículo,
     * @var Categoria
     * @OA\Property()
     */
    #[ORM\ManyToOne(targetEntity: Categoria::class)]
    #[ORM\JoinColumn(name: 'categoria_id', referencedColumnName: 'id')]
    private Categoria $categoria;

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
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