<?php
namespace App\Controllers;

use OpenApi\Annotations as OA;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

#[OA\Info(title: "API Locação de Carros", version: "0.1")]
class CarroController {

    #[OA\Get(path: '/lista')]
    #[OA\Response(response: '200', description: 'Lista de carros')]
    public function lista(Request $request, Response $response) {
        $carros = [
            ['id' => 1, 'name' => 'a'],
            ['id' => 2, 'name' => 'b'],
            ['id' => 3, 'name' => 'c']
        ];

        $json = json_encode($carros);

        $response->getBody()->write($json);

        return $response->withHeader('Content-Type', 'application/json');
    }
}