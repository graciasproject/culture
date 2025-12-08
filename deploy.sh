#!/usr/bin/env bash
set -e

# 1. Installer les dépendances JS et compiler les assets (Tailwind/Vite)
echo "Building assets..."
npm install
npm run build

# 2. Mettre en cache la config Laravel
echo "Caching config..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Lancer les migrations (force car on est en prod)
echo "Running migrations..."
php artisan migrate --force

# 4. Démarrer le serveur (Render écoute sur le port 10000 ou $PORT par défaut)
echo "Starting server..."
php artisan serve --host 0.0.0.0 --port $PORT