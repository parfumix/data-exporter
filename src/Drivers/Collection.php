<?php

namespace DataExporter\Drivers;

use DataExporter\Driver;
use DataExporter\DriverInterface;

class Collection extends Driver implements DriverInterface {

    /**
     * Set data .
     *
     * @param $data
     * @param callable $callback
     * @return $this
     */
    public function setData($data, \Closure $callback = null) {
        if(! is_null($callback))
            $data = $callback($data);

        $this->data = $data;

        return $this;
    }
}