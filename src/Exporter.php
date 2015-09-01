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
     * Set options ..
     *
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options = array()) {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options ..
     *
     * @return array
     */
    public function getOptions() {
        return $this->options;
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