<?php

namespace DataExporter\Exporters;

use DataExporter\Exporter;
use DataExporter\ExporterInterface;

class Pdf extends Exporter implements ExporterInterface {

    public function __construct(array $options = array()) {
        parent::__construct($options);

        $this->setWriter(
            app('excel')
        );
    }

    public function export($path = null) {

    }
}