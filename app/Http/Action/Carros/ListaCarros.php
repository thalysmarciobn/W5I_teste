<?php
namespace App\Http\Action\Carros;

use App\Http\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use Domain\Entity\Carro;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class ListaCarros implements RequestHandlerInterface
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $carroRepository = $this->entityManager->getRepository(Carro::class);
        $carros = $carroRepository->findAll();
        return new JsonResponse($carros);
    }
}