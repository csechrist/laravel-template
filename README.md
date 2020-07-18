# Laravel Starter Template

## Features

-   S3 File Uploads
-   Social Authentication
-   Pushing alerts
-   Email verification
-   Advanced Search Functionalities
-   Mailgun Email Sending
-   Localization
-   Use UUIDs instead of Auto-Incrementing IDs
-   Segment Integration
-   Mix CloudFront CDN

## Local Prerequisites

-   [Laravel Valet](https://laravel.com/docs/7.x/valet)
-   [PHP Redis](https://github.com/phpredis/phpredis)
-   [PostgreSQL](https://www.postgresql.org/)
-   [NodeJS](https://nodejs.org/en/)

## Required Services

-   [Stripe](https://stripe.com)
-   [Segment](https://segment.io)
-   [AWS](https://aws.amazon.com)
-   [Google ReCaptcha](https://www.google.com/recaptcha/admin/create)

## Getting Started

1. Copy `.env.example` to `.env`
2. Fill `.env` with your Environment Variables
3. Run `composer install`

## Official Packages

-   [Socialite](https://laravel.com/docs/7.x/socialite): Used for social authentication (Google, Facebook, Twitter, etc)
-   [Scout](https://laravel.com/docs/7.x/scout): Used for search functionality

## Non-Official Packages

-   [LaraTrust](https://laratrust.santigarcor.me/): Used for roles/permissions
-   [BeautyMail](https://github.com/Snowfire/Beautymail): Used for email templates
-   [Eloquent UUIDs](https://github.com/goldspecdigital/laravel-eloquent-uuid): Used for IDs in Eloquent Models
-   [AltThree Segment](https://github.com/AltThree/Segment): Used to integrate with Segment
-   [Asset-CDN](https://github.com/arubacao/asset-cdn): Used for content delivery
-   [Spatie Menus](https://docs.spatie.be/menu/v2) Used to easily create global menus

## Non-Laravel PHP Packages

-   [GuzzleHTTP](http://docs.guzzlephp.org/en/stable/): Used for HTTP requests, as well as some Laravel Functionality

## Development Packages/Tools

-   [Debugbar](https://github.com/barryvdh/laravel-debugbar): Used for development only
-   [MailHog](https://github.com/mailhog/MailHog): Used to catch SMTP requests/Show Emails
