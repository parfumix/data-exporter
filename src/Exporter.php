<?php

namespace DataExporter;

abstract class Exporter   {

    protected $options;

    protected $driver;

    public function __construct(array $options = array()) {
        $this->options = $options;
    }

    public function setDriver(DriverInterface $driver) {
        $this->driver = $driver;

        return $this;
    }

    public function getDriver() {
        return $this->driver;
    }
}