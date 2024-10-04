FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y libpq-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql

# Set the working directory
WORKDIR /var/www/html

# Copy the application code (optional if you're using volumes)
# COPY . /var/www/html