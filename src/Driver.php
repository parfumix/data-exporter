<?php

namespace DataExporter;

abstract class Driver {

    public function __construct($data) {
        $this->setData($data);
    }

}