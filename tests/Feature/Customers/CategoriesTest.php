<?php

declare(strict_types=1);

use App\Domain\Models\Category;

use function Pest\Laravel\delete;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;

use Symfony\Component\HttpFoundation\Response;

beforeEach(fn () => $this->user = userApiCredentials());

test('Deve receber o registro da categoria que correspondente ao id informado do usuario logado', function () {
    $category = Category::factory()->createOneQuietly(['userId' => $this->user->id]);

    $response = getJson(route('api.customers.categories.show', $category->id), defaultHeaders())
        ->assertOk()
        ->json();

    $expected = [
        'data' => [
            'id' => $category->id,
            'userId' => $this->user->id,
            'name' => $category->name,
            'public' => false,
            'createdAt' => $response['data']['createdAt'],
            'updatedAt' => $response['data']['updatedAt'],
            'inactivatedAt' => null,
        ],
        'status' => [
            'code' => Response::HTTP_OK,
            'message' => 'OK',
            'success' => true,
        ],
    ];

    expect($response)->toEqual($expected);
})
    ->group('feature', 'customers', 'categories', 'show', 'success');

test('Deve receber erro 404 quando buscar uma categoria nao existe ou o usuario logado nao possui', function () {
    $category = Category::factory()->createOneQuietly();

    $response = getJson(route('api.customers.categories.show', $category->id), defaultHeaders())
        ->assertNotFound()
        ->json();

    $expected = [
        'data' => [
            'message' => 'Resource not found.',
        ],
        'status' => [
            'code' => Response::HTTP_NOT_FOUND,
            'message' => 'NOT FOUND',
            'success' => false,
        ],
    ];

    expect($response)->toEqual($expected);
})
    ->group('feature', 'customers', 'categories', 'show', 'fail');

todo('Deve receber a listagem de categorias que o usuario logado cadastrou em ordem alfabetica')
    ->group('feature', 'customers', 'categories', 'index', 'success');

test('Deve receber os dados para cadastrar um nova category e retornar o status 201 com registro cadastrado', function () {
    $data = ['name' => fake()->hexColor];

    $response = postJson(route('api.customers.categories.store'), $data, defaultHeaders())
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

test('Deve receber indicacao de erros de validacao quando os campos informados nao estao conforme as regras', function () {
    $response = postJson(route('api.customers.categories.store'), [], defaultHeaders())
        ->assertUnprocessable()
        ->json();

    $expected = [
        'data' => [
            'message' => 'The name field is required.',
            'errors' => ['name' => ['The name field is required.']],
        ],
        'status' => [
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => 'UNPROCESSABLE ENTITY',
            'success' => false,
        ],
    ];

    expect($response)->toEqual($expected);
})
    ->group('feature', 'customers', 'categories', 'store', 'fail', 'validation');

test('Deve receber os dados para atualizar uma categoria já existente do usuario e retornar o status 200 com registro atualizado', function () {
    $category = Category::factory()->createOneQuietly(['userId' => $this->user->id]);

    $data = [
        'name' => fake()->hexColor,
        'inactivated' => true,
    ];

    $response = putJson(route('api.customers.categories.update', $category->id), $data, defaultHeaders())
        ->assertOk()
        ->json();

    $expected = [
        'data' => [
            'id' => $category->id,
            'userId' => $this->user->id,
            'name' => $data['name'],
            'public' => false,
            'createdAt' => $response['data']['createdAt'],
            'updatedAt' => $response['data']['updatedAt'],
            'inactivatedAt' => $response['data']['inactivatedAt'],
        ],
        'status' => [
            'code' => Response::HTTP_OK,
            'message' => 'OK',
            'success' => true,
        ],
    ];

    expect($response)->toEqual($expected);
})
    ->group('feature', 'customers', 'categories', 'update', 'success');

test('Deve receber um erro ao tentar atualizar uma categoria que nao existe', function () {
    $data = [
        'name' => fake()->hexColor,
        'inactivated' => true,
    ];

    $response = putJson(route('api.customers.categories.update', fake()->uuid), $data, defaultHeaders())
        ->assertNotFound()
        ->json();

    $expected = [
        'data' => [
            'message' => 'Resource not found.',
        ],
        'status' => [
            'code' => Response::HTTP_NOT_FOUND,
            'message' => 'NOT FOUND',
            'success' => false,
        ],
    ];

    expect($response)->toEqual($expected);
})
    ->group('feature', 'customers', 'categories', 'update', 'fail');

test('Deve receber um erro 404 ao tentar atualizar uma categoria que o usuario nao foi o criado', function () {
    $category = Category::factory()->createOneQuietly();

    $data = [
        'name' => fake()->hexColor,
        'inactivated' => true,
    ];

    $response = putJson(route('api.customers.categories.update', $category->id), $data, defaultHeaders())
        ->assertNotFound()
        ->json();

    $expected = [
        'data' => [
            'message' => 'Resource not found.',
        ],
        'status' => [
            'code' => Response::HTTP_NOT_FOUND,
            'message' => 'NOT FOUND',
            'success' => false,
        ],
    ];

    expect($response)->toEqual($expected);
})
    ->group('feature', 'customers', 'categories', 'update', 'fail');

test('Deve receber indicacao de erros de validacao ao tentar atualizar uma categoria com dados invalidos', function () {
    $category = Category::factory()->createOneQuietly(['userId' => $this->user->id]);

    $response = putJson(route('api.customers.categories.update', $category->id), [], defaultHeaders())
        ->assertUnprocessable()
        ->json();

    $expected = [
        'data' => [
            'message' => 'The name field is required. (and 1 more error)',
            'errors' => [
                'name' => ['The name field is required.'],
                'inactivated' => ['The inactivated field is required.'],
            ],
        ],
        'status' => [
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => 'UNPROCESSABLE ENTITY',
            'success' => false,
        ],
    ];

    expect($response)->toEqual($expected);
})
    ->group('feature', 'customers', 'categories', 'update', 'fail', 'validation');

test('Deve informar um id que corresponde a uma categoria criada pelo usuario logado para excluir', function () {
    $category = Category::factory()->createOneQuietly(['userId' => $this->user->id]);

    $response = delete(route('api.customers.categories.destroy', $category->id), [], defaultHeaders())
        ->assertOk()
        ->json();

    $expected = [
        'data' => [
            'message' => 'Category deleted successfully.',
        ],
        'status' => [
            'code' => Response::HTTP_OK,
            'message' => 'OK',
            'success' => true,
        ],
    ];

    expect($response)->toEqual($expected);
})
    ->group('feature', 'customers', 'categories', 'destroy', 'success');

test('Deve receber um erro ao tentar excluir uma categoria que nao existe ou nao pertence ao usuario logado', function () {
    $category = Category::factory()->createOneQuietly();

    $response = delete(route('api.customers.categories.destroy', $category->id), [], defaultHeaders())
        ->assertNotFound()
        ->json();

    $expected = [
        'data' => [
            'message' => 'Resource not found.',
        ],
        'status' => [
            'code' => Response::HTTP_NOT_FOUND,
            'message' => 'NOT FOUND',
            'success' => false,
        ],
    ];

    expect($response)->toEqual($expected);
})
    ->group('feature', 'customers', 'categories', 'destroy', 'fail');
