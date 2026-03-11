FROM php:8.2-cli

WORKDIR /app

COPY . .

RUN apt-get update && apt-get install -y git unzip nodejs npm
RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# build vite assets
RUN npm install
RUN npm run build

RUN chmod -R 775 storage bootstrap/cache

RUN cp .env.example .env
RUN php artisan key:generate

RUN php artisan config:clear
RUN php artisan route:clear
RUN php artisan view:clear

EXPOSE 8000

php artisan migrate --force && php artisan db:seed --force && php -S 0.0.0.0:8000 -t public