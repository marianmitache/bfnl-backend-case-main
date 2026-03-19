# BFNL back-end case skeleton

Includes: 
- Docker 
- Partner entity

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
```sshell
docker compose exec php-fpm php vendor/vin/phpunit
```
