# =========================
# Dockerfile: PHP + Nginx + Node + Vite
# =========================

# Base PHP 8.2 FPM
FROM php:8.2-fpm

# Instala dependências do sistema + Nginx + Node
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    zip \
    sqlite3 \
    libsqlite3-dev \
    curl \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# Diretório da aplicação
WORKDIR /var/www/html

# Copia composer.json e composer.lock para o WORKDIR
COPY composer.json composer.lock /var/www/html/

# Instala Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-dev --optimize-autoloader

# Copia todo o restante do código
COPY . /var/www/html/

# Instala dependências Node e constrói assets
RUN npm install
RUN npm run build

# Ajusta permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Copia configuração do Nginx
RUN rm /etc/nginx/sites-enabled/default
COPY ./nginx.conf /etc/nginx/conf.d/default.conf

# Expondo porta HTTP
EXPOSE 80

# Comando final para rodar PHP-FPM + Nginx
CMD ["sh", "-c", "/usr/local/bin/deploy.sh && php-fpm -D && nginx -g 'daemon off;'"]