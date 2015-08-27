<?php

namespace DataExporter;

abstract class Exporter {

    /**
     * @var array
     */
    protected $options;

    /**
     * @var
     */
    protected $driver;

    public function __construct(array $options = array()) {
        $this->options = $options;
    }

    /**
     * Set driver source .
     *
     * @param DriverInterface $driver
     * @return $this
     */
    public function setDriver(DriverInterface $driver) {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver source .
     *
     * @return mixed
     */
    public function getDriver() {
        return $this->driver;
    }
}