<?php

namespace DataExporter;

use Illuminate\Support\ServiceProvider;
use Flysap\Support;

class ExporterServiceProvider extends Serviceprovider {

    public function boot() {
        $this->publishes([
            __DIR__.'/../configuration' => config_path('yaml/exporter'),
        ]);
    }

    public function register() {
        $this->loadConfiguration();

        Support\merge_yaml_config_from(
            config_path('yaml/exporter/general.yaml') , 'laravel-exporter'
        );


        /** Register driver manager */
        $this->app->bind('driver-exportable-manager', function() {
            return (new Manager(
                config('laravel-exporter')
            ));
        });

        $this->app->singleton('locale-exporter', function($app) {
            return new Exporter(
                config('laravel-exporter'),
                $app['driver-exportable-manager']
            );
        });
    }

    protected function loadConfiguration() {
        Support\set_config_from_yaml(
            __DIR__ . '/../configuration/general.yaml' , 'laravel-exporter'
        );

        return $this;
    }
}

