<?php
namespace App\Http\Controllers\Api;

use App\Domain\Entity\Estacionamento;
use App\Http\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use OpenApi\Annotations as OA;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * @OA\Info(title="API Locação de Carros", version="0.1")
 */
final class EstacionamentoController
{

    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @OA\Get(
     *     path="/api/estacionamento/lista",
     *     summary="Lista todos os carros estacionados",
     *     description="Retorna uma lista de todos os carros estacionados",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Estacionamento")
     *         )
     *     )
     * )
     */
    public function lista(Request $request, Response $response): Response
    {
        $repository = $this->entityManager->getRepository(Estacionamento::class);

        return new JsonResponse($repository->findAll());
    }

    /**
     * @OA\Post(
     *     path="/api/estacionamento/entrada",
     *     summary="Dá entrada em um carro",
     *     description="Dá entrada em um carro no estacionamento",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados para a entrada",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"placa", "cor", "entrada", "saida", "modeloId"},
     *                 @OA\Property(property="placa", type="string", example="ABC1234"),
     *                 @OA\Property(property="cor", type="string", example="Preto"),
     *                 @OA\Property(property="modelo", type="integer", example=1)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Carro cadastrado com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro de validação dos dados",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Parâmetros inválidos")
     *         )
     *     )
     * )
     */
}