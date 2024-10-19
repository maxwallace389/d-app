# Use an official PHP image from Docker Hub
FROM php:8.0-apache

# Install any additional PHP extensions you need
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy website files into the container
COPY . /var/www/html/

# Expose port 80
EXPOSE 80
