#!/bin/bash
set -e

echo "🚀 Starting Laravel on Railway..."

# Set default PORT if not provided
export PORT=${PORT:-8080}

# Replace PORT in nginx config
echo "📝 Configuring Nginx for port $PORT..."
sed "s/PORT_PLACEHOLDER/$PORT/g" /etc/nginx/conf.d/default.conf > /tmp/nginx.conf
mv /tmp/nginx.conf /etc/nginx/conf.d/default.conf

# Fix storage permissions
echo "🔧 Setting up storage permissions..."
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/storage/framework/{sessions,views,cache}
mkdir -p /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Clear all caches to ensure fresh config
echo "🧹 Clearing caches..."
php artisan optimize:clear || true
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true
php artisan route:clear || true
php artisan event:clear || true

# Cache config for production
echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan route:cache

# Run database migrations
echo "🗄️  Running database migrations..."
php artisan migrate --force
echo "🌱 Running database seeders..."
php artisan db:seed --force

# Create storage link if it doesn't exist
echo "🔗 Creating storage link..."
php artisan storage:link || true

# Start PHP-FPM in background
echo "🐘 Starting PHP-FPM..."
php-fpm -D

# Start Nginx in foreground
echo "🌐 Starting Nginx on port $PORT..."
nginx -g "daemon off;"

