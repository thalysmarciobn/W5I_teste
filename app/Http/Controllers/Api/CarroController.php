<?php
namespace App\Http\Controllers\Api;

use App\Domain\Entity\Carro;
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
        $response = $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        $carroRepository = $this->entityManager->getRepository(Carro::class);
        $carros = $carroRepository->findAll();
        return new JsonResponse($carros);
    }
}