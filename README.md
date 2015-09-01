# Laravel Data Exporter

### Instalation
You can use the `composer` package manager to install. From console run:

```
  $ php composer.phar require parfumix/data-exporter "v1.0"
```

or add to your composer.json file

    "parfumix/data-exporter": "v1.0"

You have to publish package files using

```
  $ php artisan vendor:publish
```


### Configuration

To regiter package you have to follow standart procedure registering serviceProvider class . 
But for the first open your configuration file located in **config/app.php** and search for array of providers:

```php
  'providers' => [
        // Add that line at the end of array ..
        'DataExporter\ExporterServiceProvider'
      ]  
```

### Usage
