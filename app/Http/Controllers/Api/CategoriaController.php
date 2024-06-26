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
final class CategoriaController
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @OA\Get(
     *     path="/api/categorias/lista",
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
    public function lista(Request $request, Response $response): Response
    {
        $categorias = $this->entityManager->getRepository(Categoria::class)->findAll();

        $data = array_map(function (Categoria $categoria) {
            return [
                'id' => $categoria->getId(),
                'nome' => $categoria->getNome(),
                'taxa' => $categoria->getTaxa(),
                'numero_carros' => $categoria->getCarros()->count()
            ];
        }, $categorias);

        return new JsonResponse($data);
    }

    /**
     * @OA\Delete(
     *     path="/api/categorias/remover",
     *     summary="Remove uma categoria",
     *     description="Remove uma categoria pelo seu ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="query",
     *         description="ID da categoria a ser removida",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operação Concluída"
     *     )
     * )
     */
    public function remover(Request $request, Response $response): Response
    {
        $id = $request->getQueryParams()['id'] ?? null;

        if ($id == null)
            return new JsonResponse(['code' => 400]);

        $repository = $this->entityManager->getRepository(Categoria::class);

        $registro = $repository->find($id);

        if (!$registro)
            return new JsonResponse(['code' => 404]);

        try {
            $this->entityManager->remove($registro);
            $this->entityManager->flush();

            return new JsonResponse(['code' => 200]);
        } catch (\Exception $e) {
            return new JsonResponse(['code' => 500]);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/categorias/cadastrar",
     *     summary="Cadastrar uma nova categoria",
     *     description="Endpoint para cadastrar um novo carro",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados do carro a ser cadastrado",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"nome", "taxa"},
     *                 @OA\Property(property="nome", type="string", example="ABC1234"),
     *                 @OA\Property(property="taxa", type="double", example=1.0)
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
        $body = $request->getParsedBody();

        $nome = $body['nome'] ?? null;
        $taxa = $body['taxa'] ?? null;

        if ($nome === null || $taxa === null)
            return new JsonResponse(['code' => 500]);

        $categoriaExist = $this->entityManager->getRepository(Categoria::class)->findOneBy(['nome' => $nome]);

        if ($categoriaExist)
            return new JsonResponse(['code' => 500]);

        $categoriaModel = new Categoria();
        $categoriaModel->setNome($nome);
        $categoriaModel->setTaxa($taxa);

        $this->entityManager->persist($categoriaModel);
        $this->entityManager->flush();

        return new JsonResponse(['code' => 200]);
    }
}