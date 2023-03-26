<?php

declare(strict_types=1);

use App\Domain\ValueObjects\Uuid;

test('Deve retonar true quando o uuid é válido')
    ->expect(Uuid::isValid('f47ac10b-58cc-4372-a567-0e02b2c3d479'))
    ->toBeTrue();

test('Deve retornar false quando o uuid não é válido')
    ->expect(Uuid::isValid('invalid'))
    ->toBeFalse();

test('Devem ser iguais quando comparados dois uuids válidos')
    ->expect(
        Uuid::create('f484404f-27df-4e63-a2d8-ad79be5b946c')
        ->equals(Uuid::create('f484404f-27df-4e63-a2d8-ad79be5b946c'))
    )->toBeTrue();

test('Deve retornar o valor como string')
    ->expect(Uuid::create('c2427e6a-682c-42ac-b399-940c33119b84'))
    ->toEqual('c2427e6a-682c-42ac-b399-940c33119b84');

test('Deve retornar um uuid gerado aleatoriamente valido')
    ->expect(Uuid::random())
    ->toBeInstanceOf(Uuid::class)
    ->and(Uuid::isValid(Uuid::random()->getValue()))
    ->toBeTrue();

test('Deve lancar uma execao quando tentar criar um instancia de Uuid com um valor Uuid invalido', function () {
    Uuid::create('invalid');
})
    ->expectExceptionMessage('UUID is invalid! Please provide a valid');

test('Deve retornar uma instância de Uuid quando criado a partir de um string com uuid válido')
    ->expect(Uuid::create('0665aaa5-c0ba-4855-a89d-fd1a098c36ba'))
    ->toBeInstanceOf(Uuid::class)
    ->and(Uuid::isValid('0665aaa5-c0ba-4855-a89d-fd1a098c36ba'))
    ->toBeTrue();
