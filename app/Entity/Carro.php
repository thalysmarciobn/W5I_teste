<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'carros')]
class Carro
{
    #[Id, Column(type: 'integer'), GeneratedValue(strategy: 'AUTO')]
    private int|null $id = null;

    #[Column(type: 'string', unique: true, nullable: false)]
    public $placa;

    public function getPlaca(): string
    {
        return $this->placa;
    }

    public function setPlaca(string $placa): void
    {
        $this->placa = $placa;
    }
}