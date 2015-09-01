<?php

namespace DataExporter;

abstract class Driver {

    /**
     * @var
     */
    protected $data;

    public function __construct($data) {
        $this->setData($data);
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