FROM php:8.2-apache

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip unzip git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql \
    && a2enmod rewrite

# Copiar código
WORKDIR /var/www/html
COPY . .

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --optimize-autoloader --no-dev --no-interaction

# Node.js para Vite
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install \
    && npm run build

# CREAR .env Y CONFIGURAR
RUN cp .env.example .env
RUN sed -i 's|APP_KEY=.*|APP_KEY=base64:'"$(php artisan key:generate --show --no-ansi)"'|g' .env
RUN sed -i 's|APP_URL=.*|APP_URL='"${RENDER_EXTERNAL_URL:-http://localhost:8000}"'|g' .env
RUN sed -i 's|DB_DATABASE=.*|DB_DATABASE=/app/database/database.sqlite|g' .env

# CACHE Y MIGRACIONES
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan view:cache
RUN mkdir -p database && touch database/database.sqlite
RUN php artisan migrate --force

# PERMISOS
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 storage bootstrap/cache database

# Apache config
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

EXPOSE 80

CMD ["apache2-foreground"]