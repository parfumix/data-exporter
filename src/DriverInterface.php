<?php

namespace DataExporter;

interface DriverInterface {

    /**
     * Set data .
     *
     * @param $data
     * @param callable $callback
     * @return mixed
     */
    public function setData($data, \Closure $callback = null);

    /**
     * Get data .
     *
     * @return mixed
     */
    public function getData();
}