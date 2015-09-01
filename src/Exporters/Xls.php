<?php

namespace DataExporter\Exporters;

use DataExporter\Exporter;
use DataExporter\ExporterInterface;
use XLSXWriter;

class Xls extends Exporter implements ExporterInterface {

    public function __construct(array $options = array()) {
        parent::__construct($options);

        $this->setWriter(
            new XLSXWriter()
        );
    }

    /**
     * Export data ..
     *
     * @param $path
     * @return mixed
     */
    public function export($path) {
        $data    = $this->getDriver()->getData();
        $writter = $this->getWriter();

        $writter->writeSheet($data, '', $this->getHeader());

        return $writter->writeToFile($path);
    }
}