FROM --platform=linux/amd64 unit:1.30.0-php8.2 as container

ARG NODE_MAJOR=18

ENV WORKDIR "/code"
RUN mkdir -p ${WORKDIR}

# Install packages
RUN apt-get update && apt-get install -y \
    git \
    zip \
    curl \
    sudo \
    unzip \
    libzip-dev \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    libxml2-dev \
    g++ \
    ca-certificates \
    gnupg

# Install NodeJS
RUN sudo mkdir -p /etc/apt/keyrings
RUN curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | sudo gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg
RUN echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_MAJOR.x nodistro main" | sudo tee /etc/apt/sources.list.d/nodesource.list
RUN apt-get update && apt-get install nodejs -y
RUN curl https://www.npmjs.com/install.sh | sudo sh

RUN apt-get update && apt-get install -y git curl libmcrypt-dev default-mysql-client
# Common PHP Extensions
RUN docker-php-ext-configure gd --with-jpeg
RUN docker-php-ext-install \
    bz2 \
    intl \
    iconv \
    bcmath \
    opcache \
    calendar \
    pdo_mysql \
    zip \
    -j$(nproc) gd  \
    soap \
    pcntl \
    sockets

RUN pecl install redis \
    && docker-php-ext-enable redis

# Ensure PHP logs are captured by the container
ENV LOG_CHANNEL=stderr

# -- Install composer
RUN curl -sS https://getcomposer.org/installer | \
    php -- --install-dir=/usr/local/bin --filename=composer

FROM container

# -- Copy over entrypoint
COPY ./.nginx/  /docker-entrypoint.d/
RUN chmod +x /docker-entrypoint.d/docker-entrypoint.sh

# -- Change workdir (/code)
WORKDIR ${WORKDIR}

# -- Copy application src to workdir (/code) 
COPY . ${WORKDIR}

RUN chown -R 33:33 "/var/www"
RUN chown -R unit:unit ${WORKDIR}

# -- Install composer
RUN composer config

RUN composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev --ignore-platform-req=ext-mongodb

RUN npm install --force

RUN npm run build

RUN rm -rf node_modules

RUN chown -R unit:unit ${WORKDIR}/vendor

EXPOSE 80

CMD ["unitd","--no-daemon","--control","0.0.0.0:8080"]