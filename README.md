## This package has been renamed and moved to Glog

I've decided to put Gui and library into a standalone package. This will be helpful for development and testing. 

[https://github.com/gazatem/glog](https://github.com/gazatem/glog)


### A Log Handler for Monolog and Laravel PHP Framework


### Installation

Add the following to your composer.json and run `composer update`

```json
{
    "require": {
        "gazatem/dblogger": "dev-master"
    }
}
```

Don't forget to dump composer autoload

```php
composer dump-autoload
```

Open your config/app.php add following line in the providers array

```php
Gazatem\DBLogger\DBLoggerServiceProvider::class
```

Then in your bootstrap/app.php add / update your Monolog configiuration.

```php
$app->configureMonologUsing(function ($monolog) {
    $monolog->pushHandler(new \Gazatem\DBLogger\DBLogger());
});
```


Run following command to publish migration and configuration


```php
 php artisan vendor:publish
```


```php
 php artisan migrate
```




Open config/dblogger.php file and update the settings.

#USAGE

Do not fotget to include Log to your class

```php
use Log;
```

And add log entry
```php
Log('user.register', ['id' => 23, 'name' => 'John Doe', 'email' => 'john@example.com']);
```


## Links
[gazatem.com](https://www.gazatem.com)
