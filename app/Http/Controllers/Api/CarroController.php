<?php
namespace App\Http\Controllers\Api;

use App\Domain\Entity\Carro;
use App\Domain\Entity\Categoria;
use App\Http\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use OpenApi\Annotations as OA;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * @OA\Info(title="API Locação de Carros", version="0.1")
 */
final class CarroController
{
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
    public function lista(Request $request, Response $response): Response
    {
        $repository = $this->entityManager->getRepository(Carro::class);

        return new JsonResponse($repository->findAll());
    }

    /**
     * @OA\Post(
     *     path="/api/carros/cadastrar",
     *     summary="Cadastrar um novo carro",
     *     description="Endpoint para cadastrar um novo carro",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do carro a ser cadastrado",
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
    public function cadastrar(Request $request, Response $response): Response
    {
        $content = $request->getBody()->getContents();

        $data = json_decode($content, true);

        if ($data == null)
            return new JsonResponse(['code' => 500]);

        $placa = $data['placa'];
        $cor = $data['cor'];
        $categoriaId = $data['categoria'];

        $categoria = $this->entityManager->find(Categoria::class, $categoriaId);

        if (!$categoria)
            return new JsonResponse(['code' => 404]);

        $carroExist = $this->entityManager->getRepository(Carro::class)->findOneBy(['placa' => $placa]);

        if ($carroExist)
            return new JsonResponse(['code' => 500]);

        $carroModel = new Carro();
        $carroModel->setPlaca($placa);
        $carroModel->setCor($cor);
        $carroModel->setCategoria($categoria);

        $this->entityManager->persist($carroModel);
        $this->entityManager->flush();

        return new JsonResponse(['code' => 200]);
    }
}