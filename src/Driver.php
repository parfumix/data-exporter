<?php

namespace DataExporter;

abstract class Driver {

    /**
     * @var
     */
    protected $data;

    public function __construct($data, \Closure $callback = null) {
        $this->setData($data, $callback);
    }

    /**
     * Get data .
     *
     * @return mixed
     */
    public function getData() {
        return $this->data;
    }

}