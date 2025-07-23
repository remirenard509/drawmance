FROM php:8.2-apache

# Installer les extensions nécessaires (pdo_mysql pour MySQL)
RUN docker-php-ext-install pdo pdo_mysql

# Active mod_rewrite pour les routes propres
RUN a2enmod rewrite

# Copier les sources
COPY ./public /var/www/html
COPY ./ /var/www

# Config Apache personnalisée
COPY ./config/vhost.conf /etc/apache2/sites-available/000-default.conf
