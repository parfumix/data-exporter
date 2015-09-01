<?php

namespace DataExporter;

interface DriverInterface {

    /**
     * Set data .
     *
     * @param $data
     * @return mixed
     */
    public function setData($data);

    /**
     * Get data .
     *
     * @return mixed
     */
    public function getData();
}