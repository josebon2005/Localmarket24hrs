FROM php:8.2-fpm-alpine

# ── System dependencies ──────────────────────────────────────────────────────
RUN apk add --no-cache \
    nginx \
    supervisor \
    nodejs \
    npm \
    git \
    curl \
    zip \
    unzip \
    gettext \
    libpng-dev \
    libwebp-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    libpq-dev \
    oniguruma-dev \
    icu-dev

# ── PHP extensions ───────────────────────────────────────────────────────────
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        pdo \
        pdo_mysql \
        pdo_pgsql \
        mbstring \
        zip \
        exif \
        pcntl \
        gd \
        bcmath \
        intl

# ── Composer ─────────────────────────────────────────────────────────────────
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# ── PHP dependencies (cached layer) ──────────────────────────────────────────
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# ── Node dependencies (cached layer) ─────────────────────────────────────────
COPY package.json package-lock.json ./
RUN npm ci

# ── Application source ────────────────────────────────────────────────────────
COPY . .

# ── Build front-end assets ────────────────────────────────────────────────────
RUN npm run build

# ── Run post-install composer scripts ────────────────────────────────────────
RUN composer run-script post-autoload-dump

# ── Permissions ───────────────────────────────────────────────────────────────
RUN chown -R www-data:www-data \
        /var/www/html/storage \
        /var/www/html/bootstrap/cache \
        /var/www/html/public \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# ── Docker config files ────────────────────────────────────────────────────────
COPY docker/nginx.conf      /etc/nginx/http.d/default.conf.template
COPY docker/supervisord.conf /etc/supervisord.conf
COPY docker/start.sh        /start.sh
RUN chmod +x /start.sh

EXPOSE 8080

CMD ["/start.sh"]
