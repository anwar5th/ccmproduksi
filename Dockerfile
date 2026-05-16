# --- Stage 1: Build Frontend (Node.js) ---
FROM node:20-alpine AS frontend-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# --- Stage 2: Runtime Application (PHP 8.3) ---
FROM php:8.3-apache

# Update dan install library sistem
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd zip

RUN a2enmod rewrite

# Konfigurasi Apache Document Root ke folder public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html

# ==========================================
# PENTING: AMBIL BINARY COMPOSER DI SINI (Mengatasi Exit Code 127)
# ==========================================
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy file konfigurasi composer dulu untuk optimasi cache layer
COPY composer.json composer.lock ./

# Jalankan instalasi composer (Sekarang pasti terbaca)
RUN composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-dev \
    --prefer-dist \
    --ignore-platform-reqs \
    --optimize-autoloader

# Copy sisa source code project Laravel
COPY . .

# Copy hasil build Vite dari Stage 1
COPY --from=frontend-builder /app/public/build ./public/build

# Set permissions untuk storage & cache agar Apache bisa menulis log/session
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80