<?php
namespace App\Domain\Entity;

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

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }
}