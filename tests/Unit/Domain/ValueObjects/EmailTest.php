<?php

declare(strict_types=1);

use App\Domain\ValueObjects\Email;

test('Deve retornar true quando o email e válido')
    ->group('email', 'value-object', 'unit')
    ->expect(Email::isValid('user@email.com'))
    ->toBeTrue();

test('Deve retornar false quando o email e inválido')
    ->group('email', 'value-object', 'unit')
    ->expect(Email::isValid('invalid'))
    ->toBeFalse();

test('Deve criar uma instancia quando o email e válido')
    ->group('email', 'value-object', 'unit')
    ->expect(Email::create('user@email.com'))
    ->toBeInstanceOf(Email::class)
    ->and(Email::isValid('user@email.com'))
    ->toBeTrue();

test('Deve lançar uma excecao quando o email e invalido', function () {
    Email::create('invalid');
})
    ->group('email', 'value-object', 'unit')
    ->expectExceptionMessage('Email is invalid! Please provide a valid email address.');

test('Deve retornar true quando o email e igual ao outro email')
    ->group('email', 'value-object', 'unit')
    ->expect(Email::create('user@email.com')->equals(Email::create('user@email.com')))
    ->toBeTrue();

test('Deve imprimir o email ao forca impressao do objeto Email')
    ->group('email', 'value-object', 'unit')
    ->expect((string) Email::create('user@email.com'))
    ->toBe('user@email.com');

test('Deve retornar um email aleatorio valido')
    ->group('email', 'value-object', 'unit')
    ->expect(Email::isValid(Email::random()->getValue()))
    ->toBeTrue();
