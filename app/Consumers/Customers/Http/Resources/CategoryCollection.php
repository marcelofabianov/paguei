<?php

declare(strict_types=1);

namespace App\Consumers\Customers\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Symfony\Component\HttpFoundation\Response;

final class CategoryCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'status' => [
                'code' => Response::HTTP_OK,
                'message' => 'OK',
                'success' => true,
            ],
        ];
    }
}
