<?php
namespace App\Http\Controllers\Api;

use App\Domain\Entity\Carro;
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
     *     path="/api/estacionamento/enviar",
     *     summary="Envia um entrada ou saída de um carro",
     *     description="Dá entrada em ou saída um carro no estacionamento",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados para a entrada",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"placa", "data", "park"},
     *                 @OA\Property(property="placa", type="string", example="000000"),
     *                 @OA\Property(property="data", type="string", example="2018-06-07T10:00"),
     *                 @OA\Property(property="park", type="integer", example=1)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Entrada cadastrada com sucesso",
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
    public function enviar(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();

        $placa = $body['placa'] ?? null;
        $data = $body['data'] ?? null;
        $acao = isset($body['park']) ? intval($body['park']) : null;

        if ($placa === null || $data === null || $acao === null) {
            return new JsonResponse(['code' => 500]);
        }

        $carro = $this->entityManager->getRepository(Carro::class)->findOneBy(['placa' => $placa]);

        if (!$carro) {
            return new JsonResponse(['code' => 404]);
        }

        $estacionamento = $this->entityManager->getRepository(Estacionamento::class)->findOneBy(['carro' => $carro, 'park' => 1]);

        if ($acao == 1 && $estacionamento != null) {
            $estacionamento->setSaida(new \DateTime($data));
            $estacionamento->setPark(0);

            $this->entityManager->persist($estacionamento);
            $this->entityManager->flush();

            return new JsonResponse(['code' => 200, 'op' => 2]);
        }

        if ($acao == 0 && $estacionamento == null) {
            $estacionamento = new Estacionamento();
            $estacionamento->setEntrada(new \DateTime($data));
            $estacionamento->setPark(1);
            $estacionamento->setCarro($carro);

            $this->entityManager->persist($estacionamento);
            $this->entityManager->flush();

            return new JsonResponse(['code' => 200, 'op' => 1]);
        }

        if ($estacionamento == null) {
            return new JsonResponse(['code' => 200, 'op' => 4]);
        }

        return new JsonResponse(['code' => 200, 'op' => 3]);
    }

}