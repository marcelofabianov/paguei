<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\Response;

test('Deve acessar a rota padrao dos clientes e retornar o status 200')
    ->todo()
    ->withHeaders(['Accept' => 'application/json'])
    ->get('/api/administrators/v1')
    ->assertStatus(Response::HTTP_OK);

test('Deve barrar o acesso a rota padrao dos clientes sem autenticacao')
    ->withHeaders(['Accept' => 'application/json'])
    ->get('/api/administrators/v1')
    ->assertStatus(Response::HTTP_UNAUTHORIZED);

test('Deve barrar o acesso a rota padrao dos clientes com autenticacao de que não sao clientes')
    ->todo()
    ->withHeaders(['Accept' => 'application/json'])
    //->actingAs($this->user)
    ->get('/api/administrators/v1')
    ->assertStatus(Response::HTTP_FORBIDDEN);
