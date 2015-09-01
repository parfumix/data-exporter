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
     * @return mixed
     */
    public function export() {
        $data = $this->getDriver()->getData();

        $this->getWriter()->writeSheet($data, '', $this->getHeader());

        return $this->getWriter();
    }
}