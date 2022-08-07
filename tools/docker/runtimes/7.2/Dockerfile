FROM ubuntu:18.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y curl sudo
RUN curl -sL https://deb.nodesource.com/setup_12.x | sudo -E bash -
RUN apt-get install -yq --no-install-recommends \
    apt-utils \
    curl \
    # Install git
    git \
    # Install apache
    apache2 \
    # Install php 7.2
    libapache2-mod-php7.2 \
    php7.2-cli \
    php7.2-json \
    php7.2-curl \
    php7.2-fpm \
    php7.2-gd \
    php7.2-ldap \
    php7.2-mbstring \
    php7.2-mysql \
    php7.2-soap \
    php7.2-sqlite3 \
    php7.2-xml \
    php7.2-zip \
    php7.2-intl \
    php-xdebug\
    php-imagick \
    # Install tools
    openssl \
    nano \
    graphicsmagick \
    imagemagick \
    ghostscript \
    mysql-client \
    iputils-ping \
    locales \
    sqlite3 \
    git-core \
    nodejs \
    ca-certificates \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set locales
RUN locale-gen en_US.UTF-8 en_GB.UTF-8 de_DE.UTF-8 es_ES.UTF-8 fr_FR.UTF-8 it_IT.UTF-8 km_KH sv_SE.UTF-8 fi_FI.UTF-8

EXPOSE 80 443

WORKDIR /var/www

RUN echo 'zend_extension="/usr/local/lib/php/extensions/no-debug-non-zts-20151012/xdebug.so"' >> /etc/php/7.2/apache2/php.ini
RUN echo 'xdebug.remote_port=9000' >> /etc/php/7.2/apache2/php.ini
RUN echo 'xdebug.remote_enable=1' >> /etc/php/7.2/apache2/php.ini
RUN echo 'xdebug.remote_connect_back=1' >> /etc/php/7.2/apache2/php.ini

ADD ./entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT ["/entrypoint.sh"]

# Create new user
RUN useradd -u 1000 -m developer
RUN usermod -a -G www-data developer
RUN echo 'developer ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers
RUN echo 'Defaults !requiretty' >> /etc/sudoers

USER developer
ENV USER developer
ENV TERM xterm

CMD apachectl -D FOREGROUND 




#RUN sed -i "s/short_open_tag = Off/short_open_tag = On/" /usr/local/etc/php/php.ini-development
#RUN sed -i "s/error_reporting = .*$/error_reporting = E_ERROR | E_WARNING | E_PARSE/" /usr/local/etc/php/php.ini-development



#CMD ["php5-fpm"]