<?php

namespace DataExporter\Exporters;

use DataExporter\DriverInterface;
use DataExporter\Exporter;
use DataExporter\ExporterInterface;

class Xls extends Exporter implements ExporterInterface {

    public function export(DriverInterface $driver, array $options = array()) {
        $this->setDriver($driver);
    }
}