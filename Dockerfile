# Use an official PHP with Apache image
FROM php:8.2-apache

# Set the working directory
WORKDIR /var/www/html

# Copy project files to the container
COPY . .

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Expose port 80 for web access
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
