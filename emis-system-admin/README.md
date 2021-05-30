# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


install passport by :
    composer require laravel/passport
then migrate its database: 
    php artisan migrate and then php artisan passport:install to create the encryption keys needed to generate secure access tokens, php artisan passport:install --uuids, will instruct Passport that you would like to use UUIDs instead of auto-incrementing integers as the Passport Client 

add the laravel trait :
    Laravel\Passport\HasApiTokens in App\Models\User model.  

Next, you should call the Passport::routes method within the boot method of your App\Providers\AuthServiceProvider

Finally, in your application's config/auth.php configuration file, you should set the driver option of the api authentication guard to passport



--------------------------------------------------------------------------------
for lumen:
    visit packagist.org to search related resources tutoral
    - need to install flipbox to generate key in lumen: composer require flipbox/lumen-generator
    - Inside your bootstrap/app.php file, add:
    $app->register(Flipbox\LumenGenerator\LumenGeneratorServiceProvider::class);
    and enable AppServiceProvider,AuthServiceProvider and EventServiceProvider along with
    - and then run php artisan key:generate. this will generate application key and insert in .evn file too

    now visit here for lumen passport: https://packagist.org/packages/dusterio/lumen-passport 
    - install lumen passport : composer require dusterio/lumen-passport.
    - Modify the bootstrap flow (bootstrap/app.php file)
        // Enable Facades
        $app->withFacades();

        // Enable Eloquent
        $app->withEloquent();

        // Enable auth middleware (shipped with Lumen)
        $app->routeMiddleware([
            'auth' => App\Http\Middleware\Authenticate::class,
        ]);

        // Finally register two service providers - original one and Lumen adapter
        $app->register(Laravel\Passport\PassportServiceProvider::class);
        $app->register(Dusterio\LumenPassport\PassportServiceProvider::class);

    - Using with Laravel Passport 7.3.2 and newer
        Laravel Passport 7.3.2 had a breaking change - new method introduced on Application class that exists in Laravel but not in Lumen. You could either lock in to an older version or swap the Application class like follows at the top of your bootstrap/app.php file:
        $app = new \Dusterio\LumenPassport\Lumen7Application(
            dirname(__DIR__)
        );

    - Migrate and install Laravel Passport
        # Create new tables for Passport
        php artisan migrate

        # Install encryption keys and other necessary stuff for Passport
        php artisan passport:install

    - Configuration
        Edit config/auth.php to suit your needs. A simple example, or you need to create it:
        return [
            'defaults' => [
                'guard' => 'api',
                'passwords' => 'users',
            ],
            'guards' => [
                'api' => [
                    'driver' => 'passport',
                    'provider' => 'users',
                ],
            ],

            'providers' => [
                'users' => [
                    'driver' => 'eloquent',
                    'model' => \App\User::class
                ]
            ]
        ];

    - Load the config in bootstrap/app.php since Lumen doesn't load config files automatically:
    $app->configure('auth');

    - Registering Routes:  Next, you should call the LumenPassport::routes method within the boot method of your application (one of your service providers). This method will register the routes necessary to issue access tokens and revoke access tokens, clients, and personal access tokens:
     \Dusterio\LumenPassport\LumenPassport::routes($app);

        You can add that into an existing group, or add use this route registrar independently like so;
    \Dusterio\LumenPassport\LumenPassport::routes($app, ['prefix' => 'v1/oauth']);

    - User model: Make sure your user model uses Passport's HasApiTokens trait, eg.:
        class User extends Model implements AuthenticatableContract, AuthorizableContract
        {
            use HasApiTokens, Authenticatable, Authorizable;

            /* rest of the model */
        }

    now access the system to generate toke: from postman
        http://localhost:82/moe-usermanagement/usermanagement-backend-api/public/oauth/token
        {
            "grant_type": "client_credentials",
            "client_id": "2",
            "user_id": "3",
            "client_secret":"03woaG2vOnwNTEsvXYGzUta3i4jIxIOjNfEuRQK2",
            "username":"blake36@example.com",
            "password":"pass"
            
        }
        and type should be JSON(application/json)

    - install Cross-Origin Resource Sharing: composer require barryvdh/laravel-cors


    - install dongo api management tool: add  "dingo/api": "^3.0.0" like 
        "require": {
            "dingo/api": "^3.0.0"
        } and update the composer.
    - Open bootstrap/app.php and register the required service provider.
        $app->register(Dingo\Api\Provider\LumenServiceProvider::class);




Client ID: 1
Client secret: gU7On20NikDh9LLYHiOKOE9mndZALopJZspi0gYy
Password grant client created successfully.
Client ID: 2
Client secret: y3m7PJAx9qEgc8C4UUVGegnqgI03x3TbuKQBapUp
