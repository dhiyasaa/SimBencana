# Gunakan image PHP resmi dengan Apache
FROM php:8.2-apache

# Install dependency sistem dan ekstensi PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    curl && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd zip pdo pdo_mysql && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Aktifkan mod_rewrite Apache (dibutuhkan Laravel)
RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Salin file project ke dalam container
COPY . /var/www/html

# Atur permission direktori aplikasi Laravel
RUN chmod -R 755 /var/www/html && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache && \
    chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Set direktori kerja ke /var/www/html
WORKDIR /var/www/html

# Install dependency Laravel
RUN composer install --no-interaction --prefer-dist

# Salin konfigurasi Apache (VirtualHost)
COPY docker/apache/default.conf /etc/apache2/sites-available/000-default.conf

# Copy dan izin untuk entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Jalankan script entrypoint saat container dimulai
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# Ekspos port 80 untuk akses web
EXPOSE 80

# Perintah default untuk menjalankan Apache
CMD ["apache2-foreground"]
