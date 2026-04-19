FROM php:8.2-apache

# Remove conflicting modules
RUN a2dismod mpm_event
RUN a2dismod mpm_worker

# Enable prefork (required for PHP)
RUN a2enmod mpm_prefork

# Enable useful Apache modules
RUN a2enmod rewrite headers

# Set working directory
WORKDIR /var/www/html

# Copy project
COPY . .

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

# Apache config fix
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 80
