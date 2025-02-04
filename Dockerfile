FROM php:8.3-fpm

# Instalar extensiones necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Configurar el directorio de trabajo dentro del contenedor
WORKDIR /var/www/html

# Copiar el código fuente al contenedor
COPY . /var/www/html

# Dar permisos adecuados a los archivos
RUN chown -R www-data:www-data /var/www/html

CMD ["php-fpm"]