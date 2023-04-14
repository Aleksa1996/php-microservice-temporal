### Microservices with temporal

#### Run project

```sh
docker-compose down && docker-compose build --force-rm --no-cache && docker-compose up --force-recreate
```

```sh
php bin/console cache:pool:clear cache.global_clearer && php bin/console cache:clear && chmod 777 /var/www/html/var/* -R
```

```
vendor/bin/phpstan analyse -c phpstan.neon
```

```
vendor/bin/php-cs-fixer fix --dry-run --diff
vendor/bin/php-cs-fixer fix
```