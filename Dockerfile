# Usa una imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instala extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copia los archivos de tu aplicación
COPY . /var/www/html/

# Configura Apache para escuchar en el puerto 8080
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf \
    && sed -i 's/<VirtualHost \*:80>/<VirtualHost \*:8080>/' /etc/apache2/sites-available/000-default.conf

# Expone el puerto 8080
EXPOSE 8080

# Ejecuta Apache en el puerto correcto
CMD ["apache2-foreground"]
