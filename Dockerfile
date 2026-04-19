FROM php:8.1-apache

# Disable conflicting MPM modules
RUN a2dismod mpm_event || true
RUN a2dismod mpm_worker || true

# Enable prefork (works best with PHP)
RUN a2enmod mpm_prefork

# Enable rewrite if needed
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
