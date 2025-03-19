# Usar una imagen oficial de PHP con Apache
FROM php:8.1-apache

# Copiar el contenido de public_html al contenedor
COPY public_html/ /var/www/html/

# Habilitar mod_rewrite (si es necesario para URLs amigables)
RUN a2enmod rewrite

# Establecer los permisos correctos para el directorio de archivos
RUN chown -R www-data:www-data /var/www/html

# Exponer el puerto 80 para el servidor web
EXPOSE 80

# No es necesario un comando de inicio, Apache se encargará de todo
