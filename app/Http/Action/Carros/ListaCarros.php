<?php
namespace App\Http\Action\Carros;

use App\Http\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
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
        $carroRepository = $this->entityManager->getRepository('App\Entity\Carro');
        $carros = $carroRepository->findAll();

        print_r($carros[0]);
        return new JsonResponse($carros[0]);
    }
}