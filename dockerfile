# Usar una imagen oficial de PHP con Apache
FROM php:8.1-apache

# Copiar el contenido de public_html al contenedor
COPY public_html/ /var/www/html/

# Habilitar mod_rewrite (si es necesario)
RUN a2enmod rewrite

# Exponer el puerto 80 (por defecto para Apache)
EXPOSE 80
