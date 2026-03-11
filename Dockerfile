FROM php:8.2-apache

RUN a2dismod mpm_event
RUN a2dismod mpm_worker
RUN a2enmod mpm_prefork

RUN a2enmod rewrite

RUN docker-php-ext-install pdo pdo_mysql

RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

COPY . /var/www/html

WORKDIR /var/www/html

RUN chmod -R 775 storage bootstrap/cache
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80