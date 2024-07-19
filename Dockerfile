FROM dunglas/frankenphp

WORKDIR /app

RUN install-php-extensions \
    gd \
    pcntl \
    opcache \
    pdo \
    pdo_mysql

COPY . .
#
#ENTRYPOINT ["php", "artisan", "octane:frankenphp"]
