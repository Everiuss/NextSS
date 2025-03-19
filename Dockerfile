FROM php:8.2-apache

# Instala extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copia los archivos de la web
COPY . /var/www/html/

# Exponer el puerto 80
EXPOSE 80

CMD ["apache2-foreground"]