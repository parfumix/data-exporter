<?php

namespace DataExporter;

use Illuminate\Support\ServiceProvider;
use Flysap\Support;
use Maatwebsite\Excel\ExcelServiceProvider;

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

        $this->app->singleton('laravel-exporter', function() {
            return new ExportManager(
                config('laravel-exporter')
            );
        });

        $this->registerPackageServices();
    }

    /**
     * Register service provider dependencies .
     *
     */
    protected function registerPackageServices() {
        $providers = [
            ExcelServiceProvider::class
        ];

        array_walk($providers, function($provider) {
            app()->register($provider);
        });
    }

    protected function loadConfiguration() {
        Support\set_config_from_yaml(
            __DIR__ . '/../configuration/general.yaml' , 'laravel-exporter'
        );

        return $this;
    }
}

