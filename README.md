# SymfonyBlog
> A basic Symfony 4 CRUD application

## Quick Start

``` bash
# Install dependencies
composer install

# Edit the env file and add DB params

# Create Initial schema
php bin/console doctrine:migrations:diff
# Run migrations
php bin/console doctrine:migrations:migrate
# Load testing data with fixures
php bin/console doctrine:fixtures:load
```

## App Info

### Author

Pepe García

### Version

1.0.0

### License

This project is licensed under the MIT License
