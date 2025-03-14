# Laravel Block Bots

## Introduction

Laravel Block Bots is a package that blocks bad crawlers, people trying to scrape your website or high-usage users, but lets good and important crawlers such as GoogleBot and Bing pass-through.

## Features

- ULTRA fast, less than 1ms increase in each request.
- Verify Crawlers using reverse DNS
- Highly configurable
- Redirect users to a page when they get blocked
- Allow logged-in users to always bypass blocks

## Install

Via Composer

```bash
composer require newelement/laravel-block-bots
```

#### Requirement

- This package relies heavily on Redis. To use it, make sure that Redis is configured and ready. (see [Laravel Redis Configuration](https://laravel.com/docs/12.x/redis#configuration))

#### Config

To adjust the library, you can publish the config file to your project using:

```
php artisan vendor:publish --provider="Newelement\LaravelBlockBots\BlockBotsServiceProvider"
```

Configure variables in your .env file:

```
BLOCK_BOTS_ENABLED=true
BLOCK_BOTS_MODE=production
#options: `production` (like a charm), `never` (bypass every route), `always` (blocks every routes)
BLOCK_BOTS_USE_DEFAULT_ALLOWED_BOTS=true
BLOCK_BOTS_WHITELIST_KEY=block_bot:whitelist
BLOCK_BOTS_FAKE_BOTS_KEY=block_bot:fake_bots
BLOCK_BOTS_PENDING_BOTS_KEY=block_bot:pending_bots
BLOCK_BOTS_LOG_ENABLED=true

```

## Usage

It's simple. Go to `Kernel.php` and add to the `$routeMiddleware` block as :

```
protected $routeMiddleware = [
        ...
        'block' => \Newelement\LaravelBlockBots\Middleware\BlockBots::class,
    ];
```

Than you can put in the desired groups. For example, let's set to the Web group:

```

 protected $middlewareGroups = [
        'web' => [
            ...
            \App\Http\Middleware\VerifyCsrfToken::class,
            'block:100,daily', // 100 requests per day.
        ],
```

Where:

- **100**: is the number of pages an IP can access every day
- **daily**: is the time period. Options: `hourly`,`daily`, `weekly`, `monthly`, `annually`

## Credits

Original package by [Potelo](https://github.com/potelo)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
