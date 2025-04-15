#!/bin/sh

# Attendre que la base de données soit prête (si besoin)
sleep 10

# Exécuter les migrations (optionnel)
# php artisan migrate --force

# Nettoyer le cache et générer les fichiers nécessaires
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Démarrer le serveur Laravel
php artisan serve --host=0.0.0.0 --port=8000
