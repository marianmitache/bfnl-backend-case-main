# BFNL back-end case skeleton

Includes: 
- Docker 
- Partner entity

## Clone the repository
```shell
git clone https://github.com/marianmitache/bfnl-backend-case-main.git
```

## Set up Environment variables
```shell
cp .env.example .env
```
## Installation

```shell
composer install
docker compose up -d
docker compose exec php-fpm bin/console doctrine:migrations:migrate
docker compose exec php-fpm bin/console doctrine:fixtures:load
```

## Usage
Api is available at: 'http://localhost:49000/api'

## Testing

### Set up test db
```shell
docker compose exec php-fpm php bin/console doctrine:database:create --env=test
docker compose exec php-fpm php bin/console doctrine:migrations:migrate --env=test --no-interaction
```

### Test
```shell
docker compose exec php-fpm php vendor/bin/phpunit
```
