<?php
namespace App\Http\Response;

use Nyholm\Psr7\Response;

final class JsonResponse extends Response
{
    public function __construct(mixed $data, int $status = 200)
    {
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();
        parent::__construct(
            $status,
            (['Content-Type' => 'application/json']),
            $serializer->serialize($data, 'json')
        );
    }
}