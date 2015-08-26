<?php

namespace DataExporter;

class Exporter {

    /**
     * @var Manager
     */
    private $driverManager;

    /**
     * @var
     */
    protected $driver;

    public function __construct(array $configurations = array(), Manager $driverManager) {

        $this->configurations = $configurations;

        $this->driverManager = $driverManager;

        $this->loadDriver(
            $configurations['default_driver']
        );
    }

    /**
     * Get current active driver .
     * @return mixed
     * @throws TranslatorException
     */
    public function driver() {
        if(! $this->hasDriver())
            throw new TranslatorException(_('No active drivers.'));

        return $this->driver;
    }

    /**
     * Check if translator has active driver .
     *
     * @return bool
     */
    public function hasDriver() {
        return isset($this->driver);
    }

    /**
     * Load driver by alias .
     *
     * @param $alias
     * @return $this
     */
    public function loadDriver($alias) {
        $this->driver = $this->getDriver($alias);

        return $this;
    }

    /**
     * Get driver by alias .
     *
     * @param $alias
     * @return mixed
     */
    public function getDriver($alias) {
        return $this
            ->driverManager
            ->driver($alias);
    }

}