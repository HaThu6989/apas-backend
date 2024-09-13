FROM php:8.2-apache

# Installe les bibliothèques nécessaires à l'exécution de Symfony
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    libxslt1-dev \
    zip \
    unzip \
    && docker-php-ext-install intl pdo pdo_mysql zip xsl

# Install Composer dans le conteneur
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Répertoire de travail du conteneur, toutes les opérations suivantes s'exécuteront dans ce répertoire.
WORKDIR /var/www/html

# Copy source code to WORKDIR
COPY . .

# Install dependencies php with composer
RUN composer install --no-interaction

# Configuration permission lors de l'exécution de l'application.
RUN chown -R www-data:www-data /var/www/html/var

# Active le module mod_rewrite dans Apache. 
# Ce module est essentiel pour Symfony car il permet la réécriture des URLs, une fonctionnalité clé pour les routes de l'application.
RUN a2enmod rewrite
