<?php

declare(strict_types=1);

use function Pest\Laravel\postJson;

use Symfony\Component\HttpFoundation\Response;

beforeEach(fn () => $this->user = userApiCredentials());

test('Deve receber os dados para cadastrar um nova category e retornar o status 201 com registro cadastrado', function () {
    $data = ['name' => fake()->hexColor];

    $response = postJson(route('api.customers.categories.index'), $data, defaultHeaders())
        ->assertCreated()
        ->json();

    $expected = [
        'data' => [
            'id' => $response['data']['id'],
            'userId' => $this->user->id,
            'name' => $data['name'],
            'public' => false,
            'createdAt' => $response['data']['createdAt'],
            'updatedAt' => $response['data']['updatedAt'],
            'inactivatedAt' => null,
        ],
        'status' => [
            'code' => Response::HTTP_CREATED,
            'message' => 'CREATED',
            'success' => true,
        ],
    ];

    expect($response)->toEqual($expected);
})
    ->group('feature', 'customers', 'categories', 'store', 'success');
