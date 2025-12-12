#!/bin/bash
set -e

echo "🚀 Starting Laravel on Railway..."

# Set default PORT if not provided
export PORT=${PORT:-8080}

# Replace PORT in nginx config
echo "📝 Configuring Nginx for port $PORT..."
sed "s/PORT_PLACEHOLDER/$PORT/g" /etc/nginx/conf.d/default.conf > /tmp/nginx.conf
mv /tmp/nginx.conf /etc/nginx/conf.d/default.conf

# Clear all caches to ensure fresh config
echo "🧹 Clearing caches..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true
php artisan optimize:clear || true

# Create storage link if it doesn't exist
echo "🔗 Creating storage link..."
php artisan storage:link || true

# Start PHP-FPM in background
echo "🐘 Starting PHP-FPM..."
php-fpm -D

# Start Nginx in foreground
echo "🌐 Starting Nginx on port $PORT..."
nginx -g "daemon off;"

