#!/usr/bin/env bash
set -e

# Note: Composer install est déjà fait dans le Dockerfile, 
# mais on peut le refaire ici par sécurité ou pour les scripts post-install.

echo "Caching config..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Running migrations..."
php artisan migrate --force

echo "Starting Apache..."
# Cette commande lance Apache en premier plan
apache2-foreground