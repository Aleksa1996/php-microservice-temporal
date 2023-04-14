FROM aleksajo/php-cli-grpc:latest as shop

COPY composer.json composer.lock /var/www/html/

WORKDIR /var/www/html

CMD bash -c "composer install --no-interaction && /var/www/html/bin/rr serve -c .rr.yaml --debug"

HEALTHCHECK --interval=30s --timeout=30s \
  CMD curl http://localhost:2114/health?plugin=http -s -f -m 3 -o /dev/null || exit 1

FROM aleksajo/php-cli-grpc:latest as shop-processing

COPY composer.json composer.lock /var/www/html/

WORKDIR /var/www/html

CMD bash -c "/var/www/html/bin/rr serve -c .rr.worker.yaml --debug"

HEALTHCHECK --interval=30s --timeout=30s \
  CMD test $(pgrep -f "php /var/www/html/bin/console messenger:consume" -c) -eq 7 || exit 1