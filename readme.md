# Chip-modules

[![Build Status](https://travis-ci.org/jmrg/chip-modules.svg?branch=master)](https://travis-ci.org/jmrg/chip-modules)

Chip-modules is a set libraries that encapsulate their implementations to way easy and faster and provides the methods to access in an only step.

## Components
This includes handlers for:
- [Klein](https://github.com/klein/klein.php) - Router, controllers, and endpoints.
- [Symfony Config](https://symfony.com/doc/current/components/config.html) - Configuration from environment file.
- [Eloquent](https://github.com/illuminate/database) - Database and models.
- [Hoa Session](https://github.com/hoaproject/Session) - Session handler.
- [Blade](https://laravel.com/docs/5.1/blade) - Template manager and views.
- [PHPMailer](https://github.com/PHPMailer/PHPMailer) - Full manager to send emails.

## Installing Chip-modules Composer
You can install Chip-modules into your project using Composer. For existing applications you can run the following:
``` bash
$ composer require jmrg/chip-modules:"~0"
```


## Usage Instructions
#### Environment Config
To configure the params of the environment to create a file YAML like this with the database connection and parameters of SMTP:
```yaml
# There are file for example named example.environment.yaml

databases:
    prod:
        driver: mysql
        host: localhost
        database: database
        username: root
        password: secret
        charset: utf8
        collation: utf8_unicode_ci

mail:
    # 0 = off | 1 = Client messages | 2 = Client and server messages
    debug: 2

    # Basics
    driver: smtp
    host: smtp.mailtrap.io
    port: 2525
    username: null
    password: null

    # Encryption system: tls, ssl (deprecated)
    encryption: null
```

After that, we shoulder load the file.
```php
// Load file...
ConfigModule::init('path/to/file/config.yaml');

// Getting config...
$c = config(); // Return the config as array.
```

#### Router Config
To configure the router we make the following:
```php
// Creates a new object to the configuration.
$config = new \Chip\Modules\Router\RouterConfig();
$config->setBaseNamespace("\\Namespace\\to\\controllers") // Namespace source path.
    ->attachRouterFiles('path/to/endpoints/router.php'); // Location for the file router.

// Dispatch resquest.
$r = \Chip\Modules\Router\Router::up($config);
$r->dispatch();
```
Example using router:
```php
// File router.php

// Methods availables according to HTTP verbs: get(), post(), put(), pat(), delete(), options().
$router->get('/hellow-world', function () {
    return 'Hellow World!!';
});

// To response multiple HTTP verbs:
$router->match(['get', 'post'], '/hellow-world', function () {
    return 'Hellow World!!';
});
```

#### Databases and Model Config
To configure databases we make the following:
```php
// In the file configuration environment, we have a sections with the
// connections to the different databases, we only must send
// a connections name to configure de database.

\Chip\Modules\Model\Manager::db('nameDatabase');

// In the case of models, these must extend from \Chip\Modules\Model\Model
class User extend \Chip\Modules\Model\Model
{
    // Something code..
}
```

#### Session Config
To configure session we make the following:
```php
// Recomended to use name "guest" for the session.
\Chip\Modules\Session\Session::of('Guest'); 

// To get the session to use a guest() method.
// This returns an instance of Hoa Session. Check out the documentation
// of lirary for any information https://github.com/hoaproject/Session
$session = guest();
```

#### Views and Blade Config
To configure the blade manager template we make the following:
```php
// Define path to views and cache.
ViewComponent::config(
    '/path/to/source/views',
    '/path/to/cache'
);

// Load the view...
view(
    'name-view',
    ['param1' => 'Hello', 'param2' => 'World!!']
);

// To build views check out the documentation https://laravel.com/docs/5.1/blade
```

#### Email Config
To configure the first that we make is fill the environment file with the params require:
```yaml
# There are file for example named example.environment.yaml

mail:
    # 0 = off | 1 = Client messages | 2 = Client and server messages
    debug: 2

    # Basics
    driver: smtp
    host: smtp.mailtrap.io
    port: 2525
    username: null
    password: null

    # Encryption system: tls, ssl (deprecated)
    encryption: null
```

To get a instance the handler email we make follow:
```php
// Create a new isntance Mailer class.
$mailer = \Chip\Modules\Mailer\Mailer::create();

// To send emails or making config aditionals check out the documentation https://github.com/PHPMailer/PHPMailer
```


## Test
This project use PHPUnit to make test. To execute the test run the follow command:
```bash
$ vendor/bin/phpunit
```