<?php
namespace App\Http\Controllers\Api;

use App\Http\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use Domain\Entity\Carro;

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
     *     @OA\Response(response="200", description="Lista de Carros")
     * )
     */
    public function lista(Request $request, Response $response) {
        $carroRepository = $this->entityManager->getRepository(Carro::class);
        $carros = $carroRepository->findAll();
        return new JsonResponse($carros);
    }
}