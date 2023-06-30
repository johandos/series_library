FROM php:8-fpm

RUN docker-php-ext-install mysqli

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]