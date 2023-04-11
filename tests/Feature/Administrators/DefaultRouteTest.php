<?php

declare(strict_types=1);

use App\Domain\Models\User;
use Laravel\Passport\Passport;

use function Pest\Laravel\get;

use Symfony\Component\HttpFoundation\Response;

test('Deve receber um erro 401 ao acessar roda nao autenticado', function () {
    $response = get('/api/adm/v1', ['Accept' => 'application/json'])
        ->assertUnauthorized()
        ->json();

    expect($response)->toEqual([
        'message' => 'Unauthenticated.',
    ]);
});

test('Deve receber um erro 403 ao acessar rota autenticado como usuario comum', function () {
    Passport::actingAs(User::factory()->createOneQuietly(['role' => 'customer']), ['adm']);

    $response = get('/api/adm/v1', ['Accept' => 'application/json'])
        ->assertForbidden()
        ->json();

    expect($response)->toEqual([
        'data' => [
            'message' => 'This action is unauthorized.',
        ],
        'status' => [
            'code' => Response::HTTP_FORBIDDEN,
            'message' => 'FORBIDDEN',
            'success' => false,
        ],
    ]);
});

test('Deve acessar a rota padrao dos administradores e retornar o status 200', function () {
    Passport::actingAs(User::factory()->createOneQuietly(['role' => 'administrator']), ['adm']);

    $response = get('/api/adm/v1', ['Accept' => 'application/json'])
        ->assertOk()
        ->json();

    expect($response)->toEqual([
        'data' => [
            'message' => 'Welcome to the API of the administrators.',
        ],
        'status' => [
            'code' => Response::HTTP_OK,
            'message' => 'OK',
            'success' => true,
        ],
    ]);
});
