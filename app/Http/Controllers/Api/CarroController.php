<?php
namespace App\Http\Controllers\Api;

use App\Domain\Entity\Carro;
use App\Domain\Entity\CarroModelo;
use App\Http\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use OpenApi\Annotations as OA;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * @OA\Info(title="API Locação de Carros", version="0.1")
 */
final class CarroController {
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @OA\Get(
     *     path="/api/carros/lista",
     *     summary="Lista todos os carros",
     *     description="Retorna uma lista de todos os carros cadastrados",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Carro")
     *         )
     *     )
     * )
     */
    public function lista(Request $request, Response $response) {
        $repository = $this->entityManager->getRepository(Carro::class);
        $models = $repository->findAll();
        return new JsonResponse($models);
    }

    /**
     * @OA\Get(
     *     path="/api/carros/modelos",
     *     summary="Lista todos os modelos de carros",
     *     description="Retorna uma lista de modelos de todos os carros cadastrados",
     *     @OA\Response(
     *         response=200,
     *         description="Operação Concluída",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/CarroModelo")
     *         )
     *     )
     * )
     */
    public function modelos(Request $request, Response $response) {
        $repository = $this->entityManager->getRepository(CarroModelo::class);
        $models = $repository->findAll();
        return new JsonResponse($models);
    }
}