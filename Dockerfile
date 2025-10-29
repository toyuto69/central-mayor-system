FROM php:8.2-apache

# Dependencias
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql \
    && a2enmod rewrite

WORKDIR /var/www/html
COPY . .

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Node.js + Vite
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install \
    && npm run build

# .env y APP_KEY
RUN cp .env.example .env
RUN php artisan key:generate --force

# BASE DE DATOS
RUN mkdir -p database && touch database/database.sqlite
RUN chown www-data:www-data database/database.sqlite

# PERMISOS COMPLETOS (ESTO ES LO QUE FALTABA)
RUN mkdir -p storage/logs storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache
RUN chown -R www-data:www-data storage bootstrap/cache database
RUN chmod -R 777 storage bootstrap/cache database

# MIGRACIONES
RUN php artisan migrate --force

# Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN echo "<Directory ${APACHE_DOCUMENT_ROOT}>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" > /etc/apache2/conf-available/laravel.conf
RUN a2enconf laravel

EXPOSE 80

CMD ["apache2-foreground"]