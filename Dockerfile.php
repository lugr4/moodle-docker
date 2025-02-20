FROM php:8.3-fpm

# Instalar las dependencias de PHP y herramientas necesarias
RUN apt-get update && apt-get install -y \
    git \
    cron \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    libonig-dev \
    zip \
    unzip \
    --no-install-recommends && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install \
    gd \
    mysqli \
    pdo_mysql \
    bcmath \
    intl \
    soap \
    xml \
    zip && \
    pecl install xdebug && \
    docker-php-ext-enable xdebug && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Copiar php.ini modificado
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# Copiar script entrypoint.sh
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Configurar el cron de Moodle
RUN echo "* * * * * www-data php /var/www/moodle/admin/cli/cron.php > /dev/null 2>&1" > /etc/cron.d/moodle-cron && \
    chmod 0644 /etc/cron.d/moodle-cron && \
    crontab -u www-data /etc/cron.d/moodle-cron

# Asegurar que el servicio de cron se ejecuta al inicio
RUN touch /var/log/cron.log

WORKDIR /var/www/moodle

ENTRYPOINT ["/bin/bash", "/entrypoint.sh"]