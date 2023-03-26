<?php

declare(strict_types=1);

use App\Domain\ValueObjects\Json;

test('Deve retornar uma instanci de Json quando criado a partir de um string com json válido')
    ->expect(Json::create('{"name":"valid"}'))
    ->toBeInstanceOf(Json::class);

test('Deve retornar um objeto quando solicitado o decode de um json válido')
    ->expect(Json::create('{"name":"valid"}')->decode())
    ->toBeObject();

test('Deve retornar um string quando solicitado o encode de um json válido')
    ->expect(Json::create(['name' => 'valid'])->encode())
    ->toBeString();

test('Deve retornar uma string quando solicitado o valor do json')
    ->expect((string) Json::create(['name' => 'valid']))
    ->toBeString();

test('Devem ser iguais quando comparados dois jsons válidos')
    ->expect(Json::create(['name' => 'valid'])->equals(Json::create(['name' => 'valid'])))
    ->toBeTrue();
