<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\Response;

test('Deve acessar a rota padrao dos administradores e retornar o status 200')
    ->todo()
    ->withHeaders(['Accept' => 'application/json'])
    ->get('/api/administrators/v1')
    ->assertStatus(Response::HTTP_OK);

test('Deve barrar o acesso a rota padrao dos administradores sem autenticacao')
    ->withHeaders(['Accept' => 'application/json'])
    ->get('/api/administrators/v1')
    ->assertStatus(Response::HTTP_UNAUTHORIZED);

test('Deve barrar o acesso a rota padrao dos administradores com autenticacao de usuario comum')
    ->todo()
    ->withHeaders(['Accept' => 'application/json'])
    //->actingAs($this->user)
    ->get('/api/administrators/v1')
    ->assertStatus(Response::HTTP_FORBIDDEN);
