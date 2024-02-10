FROM php:8.2-apache

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    nano \
    git \
    && docker-php-ext-install pdo pdo_pgsql

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Configurar Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
COPY ./docker/apache-default.conf /etc/apache2/sites-available/000-default.conf

# Crear y configurar el directorio de la aplicación
WORKDIR /var/www/html/Laravel10

# Copiar archivos de la aplicación
COPY . .
