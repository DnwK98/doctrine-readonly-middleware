## Doctrine Readonly Middleware

The Doctrine Readonly Middleware package enables readonly connections 
within your application. Please note that this package is experimental 
and may not function optimally in all scenarios. Its purpose is to 
facilitate connections to readonly databases, allowing thorough 
testing of your application under such conditions.

### Installation
You can install the package via Composer:
```bash
composer require dnwk/doctrine-readonly-middleware
```

### Usage
To use the middleware, simply invoke static method
```php
ReadonlyMiddleware::enable();
```