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

    /**
     * @var
     */
    protected $writer;

    /**
     * @var
     */
    protected $header = [];

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
     * Set header .
     *
     * @param array $header
     * @return $this
     */
    public function setHeader(array $header = array()) {
        $this->header = $header;

        return $this;
    }

    /**
     * Get the header .
     *
     * @return mixed
     */
    public function getHeader() {
        return $this->header;
    }


    /**
     * Set writter .
     *
     * @param $writer
     * @return $this
     */
    public function setWriter($writer) {
        $this->writer = $writer;

        return $this;
    }

    /**
     * Get writter .
     *
     * @return mixed
     */
    public function getWriter() {
        return $this->writer;
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