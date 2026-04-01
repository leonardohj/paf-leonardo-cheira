#!/usr/bin/env bash
set -e

echo "=========================="
echo "Starting Laravel deploy..."
echo "=========================="

# Composer dependencies
echo "Running composer install..."
composer install --no-dev --optimize-autoloader

# Node / Vite assets
echo "Installing Node dependencies..."
npm install

echo "Building assets with Vite..."
npm run build

# Cache config/routes/views
echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Caching views..."
php artisan view:cache

# Run migrations (force to avoid prompt)
echo "Running database migrations..."
php artisan migrate --force

echo "=========================="
echo "Deploy finished successfully!"
echo "=========================="