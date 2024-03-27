<?php
namespace App\Http\Controllers\Api;

use App\Domain\Entity\Carro;
use App\Domain\Entity\CarroModelo;
use App\Domain\Entity\Categoria;
use App\Http\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use OpenApi\Annotations as OA;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * @OA\Info(title="API Locação de Carros", version="0.1")
 */
final class CategoriaController {
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @OA\Get(
     *     path="/api/categorias",
     *     summary="Lista todas as categorias",
     *     description="Retorna uma lista de categorias de veículos",
     *     @OA\Response(
     *         response=200,
     *         description="Operação Concluída",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Categoria")
     *         )
     *     )
     * )
     */
    public function categorias(Request $request, Response $response) {
        $repository = $this->entityManager->getRepository(Categoria::class);
        $models = $repository->findAll();
        return new JsonResponse($models);
    }
}