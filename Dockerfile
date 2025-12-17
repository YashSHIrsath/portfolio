FROM php:8.4-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev \
    default-mysql-client \
    nginx \
    supervisor \
    gettext-base

# Install Node.js 20.x (Railway recommended)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (both MySQL and PostgreSQL support)
RUN docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy composer files first for better caching
COPY composer.json composer.lock ./

# Install composer dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev --no-scripts

# Copy package files for better caching
COPY package*.json ./

# Install NPM dependencies (including dev for build)
RUN npm ci

# Copy application code
COPY . .

# Ensure public/build directory exists
RUN mkdir -p /var/www/public/build

# Build frontend assets
RUN npm run build

# Verify build output
RUN ls -la /var/www/public/build || echo "Build directory empty"

# Run composer scripts
RUN composer dump-autoload --optimize

# Set permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Ensure public/build exists and has correct permissions
RUN mkdir -p /var/www/public/build \
    && chown -R www-data:www-data /var/www/public/build \
    && chmod -R 755 /var/www/public/build

# Move Nginx config
COPY docker/nginx/conf.d/app.conf /etc/nginx/conf.d/default.conf

# Create deployment script
COPY scripts/00-laravel-deploy.sh /usr/local/bin/deploy.sh
RUN chmod +x /usr/local/bin/deploy.sh

# Railway uses PORT environment variable
EXPOSE ${PORT:-8080}

# Run the deployment script
CMD ["/usr/local/bin/deploy.sh"]
