# Usa una imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instala extensiones necesarias para Laravel
RUN docker-php-ext-install pdo pdo_mysql mbstring tokenizer xml

# Copia el código de la app al directorio de Apache
COPY . /var/www/html/

# Da permisos para almacenamiento y cache de Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expone el puerto 80
EXPOSE 80

# Comando para arrancar Apache en primer plano
CMD ["apache2-foreground"]
