FROM php:8.2-cli

# Installer les dépendances système
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_pgsql zip gd

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Définir le dossier de travail
WORKDIR /app

# Copier les fichiers du projet
COPY . .

# Vérifier que les vues existent bien
RUN ls -R /app/resources/views

# Installer les dépendances PHP et Node.js
RUN composer install --no-dev --optimize-autoloader
RUN npm install --legacy-peer-deps

# Compiler Vite pour la production
RUN npm run build

# Changer les permissions pour éviter les erreurs
RUN chmod -R 777 storage bootstrap/cache

# Rendre l'entrypoint exécutable
RUN chmod +x /app/entrypoint.sh

# Exposer les ports (8000 pour Laravel, 5173 pour Vite si besoin)
EXPOSE 8000

# Lancer le script d'entrée
CMD ["sh", "/app/entrypoint.sh"]
