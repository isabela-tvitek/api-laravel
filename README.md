<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel API

API em Laravel para demonstrar conhecimentos no framework.

### Pré-requisitos

PHP >= 8.2

Composer

Postgres

### Instalação

Um passo a passo que informa o que você deve executar para ter um ambiente de desenvolvimento em execução.

Clone o repositório para a sua máquina local:

```bash
git clone https://github.com/isabela-tvitek/api-laravel.git
cd api-laravel
```

Construir e iniciar os containers

```bash
docker-compose up -d --build
```

ou somente iniciar o container

```bash
docker-compose up -d
```

Verificar os containers

```bash
docker-compose ps
```

Executar Migrações do Laravel

```bash
docker-compose exec app php artisan migrate
```

Agora você pode acessar a aplicação em http://localhost:8000.

### Rotas

## Autenticação

Registra um novo usuário. Requer name, email e password.
 
    POST /api/register: 

Autentica um usuário e retorna um token JWT. Requer email e password.
    
    POST /api/login:

## Pipelines

Retorna todos os pipelines.

    GET /api/pipelines     

Cria um novo pipeline. Requer name.

    POST /api/pipelines 

Retorna um pipeline específico pelo ID.
 
    GET /api/pipelines/{id}

Atualiza um pipeline específico. Requer name.
    
    PUT /api/pipelines/{id}

Deleta um pipeline.
   
    DELETE /api/pipelines/{id}

## Cards
Retorna todos os cards.
    
    GET /api/cards

Cria um novo card. Requer name e description.
    
    POST /api/cards

Retorna um card específico pelo ID.
    
    GET /api/cards/{id}

Atualiza um card específico. Requer name e description.
    
    PUT /api/cards/{id}

Deleta um card.
    
    DELETE /api/cards/{id}

Move um card para o próximo pipeline. Requer pipeline_id.

    POST /api/cards/{id}/move
    

Para visualizar melhor as rotas basta acessar: 

    https://editor.swagger.io/

Pegar o conteúdo do arquivo swagger.yaml e colar no editor 

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
