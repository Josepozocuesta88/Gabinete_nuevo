<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'PROFESIONAL CONGELADOS FLORY´S'),

    /*
    |--------------------------------------------------------------------------
    | Modificaciones para el index
    |--------------------------------------------------------------------------
    | En orden podremos modificar:
    | - icono pequeñito navegador
    | - hero index
    | - logo
    | - descripcion de sobre nosotros
    | - mapa de google maps
    |
    */

    'title' => 'Profesional Congelados Florys | Baena (Córdoba)',

    'favicon' => 'images/web/logo.jpg',

    'hero_index' => 'images/web/hero-index.jpg',

    'hero_gift' => 'images/web/gift.jpg',


    'logo' => 'images/web/logo.jpg',

    'caja' => 'si',

    'telefono' => '957 690 508',

    'direccion' => 'Pol. Ind. Quiebracostillas II, Pintor Vicente Piernagorda, 76, 14850 Baena, Córdoba',

    'maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5314.670080159421!2d-4.320885096624687!3d37.62282415144168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6da169080e0c1b%3A0x6c102c3e0ae2d77d!2zUmVwb3N0ZXLDrWEgRmxvcnnCtHM!5e0!3m2!1ses!2ses!4v1700727311088!5m2!1ses!2ses',

    /*
    |--------------------------------------------------------------------------
    | Modificaciones para el login
    |--------------------------------------------------------------------------
    | En orden podremos modificar:
    | - imagen de fondo
    |
    */

    // 'bg_img' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Modificaciones generales de la web
    |--------------------------------------------------------------------------
    | En orden podremos modificar:
    | - colores corporativos
    | - puntos acumulables por compras para conseguir descuentos
    |
    */

    // 'color' => '#3490dc',
    'points' => 'Gabinete coins',
    // --color-principal: {{ config('app.color') }};

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'Europe/Madrid',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'es',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'es',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store' => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\OfertaServiceProvider::class,
        Ssheduardo\Redsys\RedsysServiceProvider::class
    ])->toArray(),

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // 'Example' => App\Facades\Example::class,
        'Redsys'    => Ssheduardo\Redsys\Facades\Redsys::class,
    ])->toArray(),

];
