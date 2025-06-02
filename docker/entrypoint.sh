#!/bin/sh

# Only run composer install if vendor directory is missing
if [ ! -d "vendor" ]; then
  echo "No vendor directory found, running composer install..."
  composer install
fi

# Start your app (or just leave it idle)
php -S 0.0.0.0:8000 -t /app