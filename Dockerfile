# Dockerfile
FROM php:8.2-apache

# Instalar dependencias
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev

# Limpiar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath
RUN docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/
RUN docker-php-ext-install gd

# Habilitar mod_rewrite para Laravel
RUN a2enmod rewrite

# Instalar composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer directorio de trabajo en /var/www/
WORKDIR /var/www/

# Copiar el directorio existente en el contenedor
COPY . .

# Copiar los assets compilados al contenedor
COPY public/build /var/www/public/build

# Establecer el DocumentRoot para Apache
ENV APACHE_DOCUMENT_ROOT /var/www/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copiar el archivo de configuración .env
COPY .env .env

# Copiar la configuración de Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Instalar las dependencias del proyecto
RUN composer install --no-scripts --no-autoloader

# Copiar el script de entrada
COPY entrypoint.sh /usr/local/bin/

# Hacerlo ejecutable
RUN chmod +x /usr/local/bin/entrypoint.sh

# Usarlo como el punto de entrada
ENTRYPOINT ["entrypoint.sh"]

# Comando para iniciar el servidor web al ejecutar el contenedor
CMD composer dump-autoload --optimize && php artisan key:generate && apache2-foreground

# Exponer el puerto 80 para el servidor web
EXPOSE 80
