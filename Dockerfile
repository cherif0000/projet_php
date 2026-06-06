FROM php:8.2-apache
 
# Extensions PHP
RUN docker-php-ext-install pdo pdo_mysql
 
# Activer mod_rewrite
RUN a2enmod rewrite
 
# Autoriser .htaccess dans tout le projet
RUN sed -i 's|<Directory /var/www/html/>|<Directory /var/www/html/>\n    AllowOverride All|g' /etc/apache2/sites-available/000-default.conf
 
# Aussi dans apache2.conf
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf
 
# Copier le projet
COPY . /var/www/html/
 
# Permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
 
EXPOSE 80