FROM php:7.4-apache

# Install additional dependencies
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
       git \
       unzip \
    && rm -rf /var/lib/apt/lists/*

# Set up Apache
RUN a2enmod rewrite

# Set the working directory
WORKDIR /workspace

# Expose the port
EXPOSE 80
