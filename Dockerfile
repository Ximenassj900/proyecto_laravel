
FROM php:8.2-apache


RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring xml


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


COPY . /var/www/html/


WORKDIR /var/www/html

# Eliminar caché antigua y asignar permisos correctos
RUN rm -rf vendor composer.lock \
    && chown -R www-data:www-data /var/www/html

# Instalar dependencias
RUN composer install --no-dev --optimize-autoloader


RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache


EXPOSE 80


CMD ["apache2-foreground"]
