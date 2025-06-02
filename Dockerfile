FROM php:8.2-cli

# Set working directory
WORKDIR /app

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libicu-dev \
    libzip-dev \
    && docker-php-ext-install zip intl \
    && docker-php-ext-configure intl 
    # && docker-php-ext-install

RUN curl -sS https://getcomposer.org/installer | php \
    -- --install-dir=/usr/local/bin --filename=composer

# Copy composer files first to leverage Docker cache
COPY composer.json /app/

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-interaction --prefer-dist

# Now copy the rest of the app (this must come after install!)
COPY . /app  

# Set default command to run tests
CMD ["php", "-S", "0.0.0.0:8000", "-t", "/app"]