#!/bin/bash
set -e

echo "🚀 Starting Laravel deployment on Railway..."

# Set default PORT if not provided
export PORT=${PORT:-8080}

# Replace PORT in nginx config
echo "📝 Configuring Nginx for port $PORT..."
envsubst '${PORT}' < /etc/nginx/conf.d/default.conf > /tmp/nginx.conf
mv /tmp/nginx.conf /etc/nginx/conf.d/default.conf

# Create storage link if it doesn't exist
echo "🔗 Creating storage link..."
php artisan storage:link || true

# Run migrations
echo "🗄️  Running migrations..."
php artisan migrate --force

# Cache config and routes
echo "⚡ Caching configuration..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start PHP-FPM in background
echo "🐘 Starting PHP-FPM..."
php-fpm -D

# Start Nginx in foreground
echo "🌐 Starting Nginx on port $PORT..."
nginx -g "daemon off;"

