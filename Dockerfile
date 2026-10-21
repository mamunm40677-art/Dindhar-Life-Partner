# Stage 1: Build Frontend Assets
FROM node:20-slim AS frontend
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: PHP Application
FROM php:8.4-apache

# Install required system packages for Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libzip-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd zip bcmath \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set Working Directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html

# Copy compiled frontend assets from frontend stage
COPY --from=frontend /app/public/build /var/www/html/public/build

# Configure Apache Document Root to public/
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV APP_KEY="base64:d1R1T2lsSVRrbWRtZXBrS0FwSWZzUFBvM2E4TWN6Wmc="
ENV DB_CONNECTION=sqlite
ENV CACHE_STORE=file
ENV CACHE_DRIVER=file
ENV SESSION_DRIVER=file
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/conf-available/*.conf

# Install Composer dependencies
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Set Permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database \
    && chmod -R 777 /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

# Copy entrypoint script
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
