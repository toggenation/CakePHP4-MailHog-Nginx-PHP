# CakePHP 4 Queue on Docker

1. Clone this repo 

```
git clone https://github.com/toggenation/cakephp4-queue
```



2. Rename `~/env.example` to `.env` 

3. Modify the PORTS in `.env` to not conflict with other Docker containers


4. Build
```
docker-compose build
```

5. Install deps
```
composer install
composer require cakephp/queue
composer require enqueue/redis predis/predis:^1
bin/cake plugin load 'Cake/Queue'
```

Edit `config/app_local.php` and get the `.env` DB settings

* Add DB
* Mail settings
* Queue config array

### DB

```php
  // config/app_local.php
 'default' => [
            /* change values to match .env values
             *  DB_HOST=mysql
             *  DB_DATABASE=devtest
             *  DB_USERNAME=devtest
             *  DB_PASSWORD=devtest
             */
            'host' => 'mysql',
            'username' => 'devtest',
            'password' => 'devtest',
            'database' => 'devtest',
        ],

```

### Email

```php

 'EmailTransport' => [
        'default' => [
            // change host to mailhog
            'host' => 'mailhog',

            // port to whatever is specified in .env MAIL_PORT=1025
            'port' => 1025,

            // force the use of Smtp by adding the following
            'className' => SmtpTransport::class, 
            'username' => null,
            'password' => null,
            'client' => null,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
    ],
```
### Cake/Queue

```php
'Queue' => [
    'default' => [
        // A DSN for your configured backend. default: null
        'url' => 'redis://redis',

        // The queue that will be used for sending messages. default: default
        // This can be overriden when queuing or processing messages
        'queue' => 'default',

        // The name of a configured logger, default: null
        'logger' => 'stdout',

        // The name of an event listener class to associate with the worker
        'listener' => \App\Listener\WorkerListener::class,

        // The amount of time in milliseconds to sleep if no jobs are currently available. default: 10000
        'receiveTimeout' => 10000,
    ]
],
```
```sh
docker-compose up -d
```

### Connect to web

If NGINX_PORT is in `.env` as follows then [http://localhost:8080](http://localhost:8080)

```
// .env
NGINX_PORT=8080
```

### Install Cross Platform Redis GUI
Another Redis Desktop Manager
[https://github.com/qishibo/AnotherRedisDesktopManager](https://github.com/qishibo/AnotherRedisDesktopManager)




### Video Timings
I put a video of this up on Youtube []()
