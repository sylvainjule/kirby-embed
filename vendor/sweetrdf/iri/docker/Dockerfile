FROM php:8.4-cli

RUN apt-get update && apt-get install -y git libzip-dev zip zlib1g-dev \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN groupadd -g 1000 iri && \
    useradd -m -u 1000 -g iri -G www-data -s /bin/bash iri

# Helper script to avoid git warning about different owners of the project directory.
COPY ./entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

WORKDIR /home/iri/code

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
