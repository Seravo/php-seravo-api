FROM ghcr.io/seravo/ubuntu:noble

RUN sed -i 's/main$/main universe/g' /etc/apt/sources.list && \
    apt-setup && \
    apt-get --assume-yes install \
      composer \
      php-cli \
      php-xml && \
    apt-cleanup

RUN useradd --create-home user && \
    mkdir -p /src && \
    chown user /src

WORKDIR /src
COPY composer.json .

USER user

RUN composer install

COPY . .
