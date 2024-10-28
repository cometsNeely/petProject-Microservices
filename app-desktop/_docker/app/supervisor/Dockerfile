FROM php:8.2-fpm

RUN docker-php-ext-install pdo pdo_mysql

# Install Redis extension
RUN pecl install redis \
&& rm -rf /tmp/redis \
&& docker-php-ext-enable redis

# Install supervisord
RUN apt-get update && apt-get upgrade -y && apt-get install -y supervisor

# Make supervisor log directory
RUN mkdir -p "/etc/supervisor/logs"

# Copy the Supervisor configuration file
COPY ./app-desktop/_docker/app/supervisord.conf /etc/supervisor/supervisord.conf

# Start supervisord
CMD ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisor/supervisord.conf"]
