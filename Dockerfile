# --------------------  PHP + Apache  --------------------
FROM php:8.1-apache

# ── Dependencias de sistema necesarias para las extensiones PHP ──
RUN apt-get update && apt-get install -y \
    libonig-dev       \
    libicu-dev        \
    libjpeg-dev       \
    libpng-dev        \
    libfreetype6-dev  \
    libzip-dev        \
    zip unzip         \
    libxml2-dev       \
 && docker-php-ext-configure gd --with-jpeg --with-freetype \
 && docker-php-ext-install mysqli pdo pdo_mysql mbstring intl gd

# ── Habilitamos mod_rewrite ──
RUN a2enmod rewrite

# (Opcional) Cambia DocumentRoot si tu proyecto usa /public
# ENV APACHE_DOCUMENT_ROOT /var/www/html
# RUN sed -ri "s!/var/www/html!${APACHE_DOCUMENT_ROOT}!g" \
#     /etc/apache2/sites-available/000-default.conf

# ── Copiamos el proyecto ──
COPY . /var/www/html/

# ── Permisos ──
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
