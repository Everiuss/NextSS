# Usa la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instala extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copia los archivos al contenedor
COPY . /var/www/html/

# Cambia el puerto de Apache a 8080
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf \
    && sed -i 's/:80/:8080/g' /etc/apache2/sites-enabled/000-default.conf

# Expone el puerto 8080
EXPOSE 8080

# Ejecuta Apache en primer plano
CMD ["apache2-foreground"]
