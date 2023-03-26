# Paguei

Este é um projeto para ajudar a organizar as contas do dia a dia de uma pessoa.

## Como funciona?

 O projeto é feito com base em um API REST, utilizando o framework Laravel / Passport que segue o padrão OAuth.
 Está definido neste projeto a autenticação utilizando token do tipo "Bearer" e o padrão de resposta é em JSON.

## Pre-requisitos

- Docker v20
- Docker Compose v2.4
- Git

## Tecnologias

- PHP 8.2
- PostgresSQL 15
- Redis 7
- Nginx 1.23
- Laravel 10

## Ferramentas de qualidade e segurança...

- Pest
- Pint
- Psalm
- captainhook
- security-advisories
- laradumps
- xdebug

## Como utilizar?

1. Clone o repositório para sua maquina

```bash
https://github.com/marcelofabianov/paguei.git
```

2. Remova o diretório git do projeto

```bash
rm -rf .git && git init
```

3. Copie os arquivos de variaveis de ambiente

```bash
cp environments/local/alias.sh . && cp environments/local/.env.example .env && cp environments/local/.env.testing . && cp environments/local/docker-compose.yml .
```

4. Carregue os alias para seu terminal

```bash
source alias.sh
```

5. Inicie os containers docker

```bash
pg.up
```

ou

```bash
docker compose up -d
```

6. Instale as dependencias do projeto

```bash
pg.composer install
```

7. Gere uma chave de criptografia

```bash
pg.art key:generate
```

8. Gere uma chave de OAuth

```bash
pg.art passport:keys
```

9. Execute as migrations

```bash
pg.migrate
```

10. Gere os dados de teste para utilizar a API

```bash
pg.oauth
```

11. Execute o cURL para testar a API

Substitua os valores de "..." pelos dados gerados no passo 10.

```bash
```bash
curl --location 'http://localhost/oauth/token' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
  "grant_type":"password",
  "client_id":"...",
  "client_secret":"...",
  "username":"bob@email.com",
  "password":"password",
  "scope":"*"
}'
```

12. Execute os testes

```bash
pg.test
```

13. Execute o lint quando precisar

```bash
pg.lint
```

14. Check a sintaxe do código

```bash
pg.psalm
```

15. Leia os alias disponíveis

```bash
pg.help
```
