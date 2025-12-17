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
mkdir -p /var/www/storage/logs
mkdir -p /var/www/storage/framework/{sessions,views,cache}
mkdir -p /var/www/bootstrap/cache
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Clear all caches to ensure fresh config
echo "🧹 Clearing caches..."
php artisan config:clear || true
php artisan cache:clear || true
php artisan view:clear || true
php artisan route:clear || true
php artisan optimize:clear || true

# Cache config for production
echo "⚡ Optimizing for production..."
php artisan config:cache
php artisan view:cache

# Run database migrations
echo "🗄️  Running database migrations..."
php artisan migrate --force

# Create storage link if it doesn't exist
echo "🔗 Creating storage link..."
php artisan storage:link || true

# Check if Vite manifest exists
if [ ! -f /var/www/public/build/manifest.json ]; then
    echo "⚠️  WARNING: Vite manifest not found at /var/www/public/build/manifest.json"
    echo "📁 Listing public directory:"
    ls -la /var/www/public/
    echo "📁 Listing build directory (if exists):"
    ls -la /var/www/public/build/ || echo "Build directory does not exist"
fi

# Start PHP-FPM in background
echo "🐘 Starting PHP-FPM..."
php-fpm -D

# Start Nginx in foreground
echo "🌐 Starting Nginx on port $PORT..."
nginx -g "daemon off;"

